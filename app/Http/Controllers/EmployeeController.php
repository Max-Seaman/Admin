<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $sortField = $request->get('sort_by', 'first_name');
        $sortDirection = $request->get('direction', 'asc');

        $allowedColumns = ['first_name', 'last_name', 'email', 'company_id'];
        $allowedDirections = ['asc', 'desc'];

        if (!in_array($sortField, $allowedColumns)) {
            $sortField = 'first_name';
        }

        if (!in_array($sortDirection, $allowedDirections)) {
            $sortDirection = 'asc';
        }

        $employees = Employee::with('company')
            ->orderBy($sortField, $sortDirection)
            ->simplePaginate(10);

        return view('employees/index', [
            'employees' => $employees,
            'sortField' => $sortField,
            'sortDirection' => $sortDirection,
        ]);
    }


    public function create()
    {
        $companies = Company::orderBy('name')->get();

        return view('employees/create', [
            'companies' => $companies,
        ]);
    }

    public function show(Employee $employee)
    {
        return view('employees/show', ['employee' => $employee]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'nullable|email|max:255',
            'phone'      => 'nullable|string|max:25',
            'company_id' => 'required|exists:companies,id',
        ]);

        $validated['logo'] = 'img/default-employee.png';

        Employee::create($validated);

        return redirect('/employees');
    }

    public function edit(Employee $employee)
    {
        $companies = Company::orderBy('name')->get();

        return view('employees/edit', [
            'employee' => $employee,
            'companies' => $companies]);
    }

    public function update(Request $request, Employee $employee)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'nullable|email|max:255',
            'phone'      => 'nullable|string|max:25',
            'company_id' => 'required|exists:companies,id',
        ]);

        $validated['logo'] ='img/default-employee.png';

        $employee->update($validated);

        //redirect
        return redirect('employees/' . $employee->id);  
    }

    public function destroy(Employee $employee)
    {
        //delete
        $employee->delete();

        //redirect
        return redirect('/employees');
    }
}
