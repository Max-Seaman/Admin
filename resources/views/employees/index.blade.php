@extends('layouts.app')

@section('content')
    <x-page-header>Employees</x-page-header>

    <div class="container mt-5">
        <div class="rounded overflow-auto">
            <table class="w-100 rounded">
                <thead>
                    <tr class="text-white bg-custom-green-light text-center fs-5">
                        <th class="py-3">
                            <a href="{{ route('employees.index', ['sort_by' => 'first_name', 'direction' => $sortField === 'first_name' && $sortDirection === 'asc' ? 'desc' : 'asc']) }}"
                               class="text-white text-decoration-none">
                                First Name
                                @if ($sortField === 'first_name')
                                    <span>{{ $sortDirection === 'asc' ? '▲' : '▼' }}</span>
                                @endif
                            </a>
                        </th>

                        <th>
                            <a href="{{ route('employees.index', ['sort_by' => 'last_name', 'direction' => $sortField === 'last_name' && $sortDirection === 'asc' ? 'desc' : 'asc']) }}"
                               class="text-white text-decoration-none">
                                Last Name
                                @if ($sortField === 'last_name')
                                    <span>{{ $sortDirection === 'asc' ? '▲' : '▼' }}</span>
                                @endif
                            </a>
                        </th>

                        <th>
                            <a href="{{ route('employees.index', ['sort_by' => 'email', 'direction' => $sortField === 'email' && $sortDirection === 'asc' ? 'desc' : 'asc']) }}"
                               class="text-white text-decoration-none">
                                Email
                                @if ($sortField === 'email')
                                    <span>{{ $sortDirection === 'asc' ? '▲' : '▼' }}</span>
                                @endif
                            </a>
                        </th>

                        <th>Phone Number</th>

                        <th>
                            <a href="{{ route('employees.index', ['sort_by' => 'company_id', 'direction' => $sortField === 'company_id' && $sortDirection === 'asc' ? 'desc' : 'asc']) }}"
                               class="text-white text-decoration-none">
                                Company
                                @if ($sortField === 'company_id')
                                    <span>{{ $sortDirection === 'asc' ? '▲' : '▼' }}</span>
                                @endif
                            </a>
                        </th>
                    </tr>
                </thead>

                <tbody class="fs-5">
                    @foreach ($employees as $employee)
                        <tr class="clickable-row text-white {{ $loop->odd ? 'bg-custom-green-mid' : 'bg-custom-green-light' }} text-nowrap"
                            data-href="{{ route('employees.show', $employee->id) }}">
                            <td class="name-logo py-3 px-3 d-flex align-items-center">
                                <img class="logo rounded-circle me-2" src="{{ $employee->logo_url }}" alt="Employee Logo" style="max-height: 40px;">
                                <span>{{ $employee->first_name }}</span>
                            </td>
                            <td class="px-3 text-center">{{ $employee->last_name }}</td>
                            <td class="px-3 text-center">{{ $employee->email }}</td>
                            <td class="px-3 text-center">{{ $employee->phone }}</td>
                            <td class="px-3 text-center">{{ $employee->company->name }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination (keep sort state) -->
        <div class="mt-5">
            {{ $employees->appends(request()->only('sort_by', 'direction'))->links() }}
        </div>
    </div>
@endsection
