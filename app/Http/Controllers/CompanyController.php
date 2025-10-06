<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index(Request $request)
    {
        // Get sort parameters
        $sortField = $request->get('sort_by', 'name');   // default: name
        $sortDirection = $request->get('direction', 'asc');    // default: A-Z

        // Allow only valid columns & directions
        $allowedColumns = ['name', 'email', 'website', 'updated_at', 'employees_count'];
        $allowedDirections = ['asc', 'desc'];

        if (!in_array($sortField, $allowedColumns)) {
            $sortField = 'updated_at';
        }

        if (!in_array($sortDirection, $allowedDirections)) {
            $sortDirection = 'desc';
        }

        // Fetch companies
        $companies = Company::withCount('employees')
            ->orderBy($sortField, $sortDirection)
            ->simplePaginate(10);

        return view('companies.index', [
            'companies' => $companies,
            'sortField' => $sortField,
            'sortDirection' => $sortDirection
        ]);
    }
    
    public function create()
    {
        return view('companies/create');
    }

    public function show(Request $request, Company $company)
    {
        // Sorting parameters for the employees table
        $sortField = $request->get('sort_by', 'id');
        $sortDirection = $request->get('direction', 'asc');

        $allowedColumns = ['id', 'first_name', 'last_name', 'email'];
        $allowedDirections = ['asc', 'desc'];

        if (!in_array($sortField, $allowedColumns)) {
            $sortField = 'id';
        }

        if (!in_array($sortDirection, $allowedDirections)) {
            $sortDirection = 'asc';
        }

        // Get the employees of this company, sorted
        $employees = $company->employees()
            ->orderBy($sortField, $sortDirection)
            ->simplePaginate(5);

        return view('companies.show', [
            'company' => $company,
            'employees' => $employees,
            'sortField' => $sortField,
            'sortDirection' => $sortDirection,
        ]);
    }

    public function store(Request $request)
    {
        //validation
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'website' => 'nullable|url',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg|max:2048|dimensions:min_width=100,min_height=100',
        ]);

        // Handle logo upload or default
        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('logos', 'public');
        } else {
            // Use your default logo (make sure this file exists in storage/app/public/logos/)
            $validated['logo'] = 'img/default-company.png';
        }

        //create
        Company::create($validated);

        return redirect('/companies');
    }

    public function edit(Company $company)
    {
        return view('companies/edit', ['company' => $company]);
    }

    public function update(Request $request, Company $company)
    {

         // Validate incoming data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'website' => 'required|url',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg|max:2048|dimensions:min_width=100,min_height=100',
        ]);

        // Handle logo upload or keep the same/default
        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('logos', 'public');
        } else {
            // Keep current logo, or use public default if none exists
            $validated['logo'] = $company->logo ?? 'img/default-company.png';
        }

        // Update the company with validated data
        $company->update($validated);

        //redirect
        return redirect('companies/' . $company->id);  
    }

    public function destroy(Company $company)
    {
        //delete
        $company->delete();

        //redirect
        return redirect('/companies');
    }
}
