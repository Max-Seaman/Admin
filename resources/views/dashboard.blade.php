@extends('layouts.app')

@section('content')
    <x-page-header>Dashboard</x-page-header>

    <div class="container mt-5">
        <div class="bg-custom-green text-white rounded p-4 mb-5">
            <h2 class="fs-2 mb-2">Welcome</h2>
            <p class="mb-0 fs-5">There are currently <strong>{{ $companyCount }}</strong> companies and <strong>{{ $employeeCount }}</strong> employees in the system.</p>
        </div>

        <div class="row g-2">
            <div class="col-12 col-lg-6 pe-lg-1 mb-4 mb-lg-0">
                <div class="rounded overflow-hidden">
                    <table class="w-100 rounded table-responsive-md">
                        <thead>
                            <tr class="text-white bg-custom-green-light text-center fs-5">
                                <th class="py-3">Recently Created Companies</th>
                                <th>Created</th>
                            </tr>
                        </thead>
                        <tbody class="fs-5">
                            @foreach ($recentCompanies as $company)
                                <tr class="clickable-row text-white {{ $loop->odd ? 'bg-custom-green-mid' : 'bg-custom-green-light' }}" data-href="{{ route('companies.show', $company->id) }}">
                                    <td class="name-logo py-3 px-3 d-flex align-items-center">
                                        <div class="d-flex align-items-center justify-content-center me-2 bg-white rounded-circle" style="width: 40px; height: 40px;">
                                            <img class="logo rounded-circle" src="{{ $company->logo_url }}" alt="Company Logo" style="max-height: 30px; max-width: 30px;">
                                        </div>
                                        <span>{{ $company->name }}</span>
                                    </td>
                                    <td class="text-center">{{ $company->created_at->format('jS F Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>    
            </div>
            <div class="col-12 col-lg-6 ps-lg-1">
                <div class="rounded overflow-hidden">
                    <table class="w-100 rounded table-responsive-md">
                        <thead>
                            <tr class="text-white bg-custom-green-light text-center fs-5">
                                <th class="py-3">Recently Created Employees</th>
                                <th>Created</th>
                            </tr>
                        </thead>
                        <tbody class="fs-5">
                            @foreach ($recentEmployees as $employee)
                                <tr class="clickable-row text-white {{ $loop->odd ? 'bg-custom-green-mid' : 'bg-custom-green-light' }}" data-href="{{ route('employees.show', $employee->id) }}">
                                    <td class="name-logo py-3 px-3 d-flex align-items-center">
                                        <img class="logo rounded-circle me-2" src="{{ $employee->logo_url }}" alt="Employee Logo" style="max-height: 40px;">
                                        <span>{{ $employee->first_name . ' ' . $employee->last_name }}</span>
                                    </td>
                                    <td class="text-center">{{ $employee->created_at->format('jS F Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>    
            </div>
        </div>
    </div>
@endsection
