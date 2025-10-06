<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $companyCount = Company::count();
        $employeeCount = Employee::count();

        // Get 5 most recently created companies and employees
        $recentCompanies = Company::latest()->take(5)->get();
        $recentEmployees = Employee::latest()->take(5)->get();

        return view('dashboard', [
            'companyCount' => $companyCount,
            'employeeCount' => $employeeCount,
            'recentCompanies' => $recentCompanies,
            'recentEmployees' => $recentEmployees,
        ]);
    }
}
