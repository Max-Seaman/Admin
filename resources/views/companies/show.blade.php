@extends('layouts.app')

@section('content') 
    <x-page-header><a class="underline nav-link d-inline" href="{{ route('companies.index') }}">Companies</a> / {{ $company->name }}</x-page-header>

    <div class="container">
        <div class="d-flex flex-column my-5 text-white bg-custom-green p-4 rounded">
            <h3 class="text-center text-sm-start mt-sm-3 ms-sm-3 fs-1">{{ $company->name }}</h3>
            <div class="d-flex flex-column flex-sm-row align-items-center my-4 flex-nowrap">
                <div class="bg-white m-4 d-flex align-items-center justify-content-center rounded-circle flex-shrink-0" style="width: 130px; height: 130px;">
                    <img class="rounded-circle" src="{{ $company->logo_url }}" alt="Company Logo" style="max-width: 90px; max-height: 90px;">
                </div>
                <div class="details ms-sm-3 fs-5">
                    @if ($company->email)
                        <p><a class="underline nav-link" href="mailto:{{ $company->email }}" target="_blank">{{ $company->email }}</a></p>
                    @endif
                    @if ($company->website)
                        <p><a class="underline nav-link d-inline" href="{{ $company->website }}" target="_blank">Visit Website</strong></a> <span class="link-text">({{ Str::limit($company->website, 30) }})</span></p>
                    @endif
                    @if ($company->employees()->count())
                        <p>Total Employees: {{ $company->employees()->count() }}</p>
                    @else
                        <p>This company has no employees.</p>
                    @endif
                </div>
            </div>

            <div class="dates mt-sm-3 ms-sm-3 text-center text-sm-start fs-5">
                <p>Created on {{ $company->created_at->format('jS F Y') }}</p>
                @if ($company->created_at != $company->updated_at)
                    <p>Updated on {{ $company->updated_at->format('jS F Y') }}</p>
                @endif
            </div>
        
            <div class="buttons border-top border-custom-green-light pt-3 mt-3 px-2 w-100 d-flex justify-content-between">
                <x-button href="{{ route('companies.index') }}">Back</x-button>
                <x-button href="{{ route('companies.edit', $company->id) }}">Edit</x-button>
                <form method="POST" class="deleteForm" action="{{ route('companies.destroy', $company) }}" data-name="{{ $company->name }}">
                    @csrf
                    @method('DELETE')
                    <x-button type="submit">Delete</x-button>
                </form>
            </div>
        </div>

        <div class="rounded overflow-auto">
            <table class="w-100 rounded">
                <thead>
                    <tr class="text-white bg-custom-green-light text-center fs-5">
                        <th class="py-3">
                            <a href="{{ route('companies.show', [
                                'company' => $company->id,
                                'sort_by' => 'id',
                                'direction' => $sortField === 'id' && $sortDirection === 'asc' ? 'desc' : 'asc'
                            ]) }}" class="text-white text-decoration-none">
                                ID
                                @if ($sortField === 'id')
                                    <span>{{ $sortDirection === 'asc' ? '▲' : '▼' }}</span>
                                @endif
                            </a>
                        </th>
                        <th>
                            <a href="{{ route('companies.show', [
                                'company' => $company->id,
                                'sort_by' => 'first_name',
                                'direction' => $sortField === 'first_name' && $sortDirection === 'asc' ? 'desc' : 'asc'
                            ]) }}" class="text-white text-decoration-none">
                                Name
                                @if ($sortField === 'first_name')
                                    <span>{{ $sortDirection === 'asc' ? '▲' : '▼' }}</span>
                                @endif
                            </a>
                        </th>
                        <th>
                            <a href="{{ route('companies.show', [
                                'company' => $company->id,
                                'sort_by' => 'email',
                                'direction' => $sortField === 'email' && $sortDirection === 'asc' ? 'desc' : 'asc'
                            ]) }}" class="text-white text-decoration-none">
                                Email
                                @if ($sortField === 'email')
                                    <span>{{ $sortDirection === 'asc' ? '▲' : '▼' }}</span>
                                @endif
                            </a>
                        </th>
                        <th>Phone Number</th>
                    </tr>
                </thead>

                <tbody class="fs-5">
                    @foreach ($employees as $employee)
                        <tr class="clickable-row text-white {{ $loop->odd ? 'bg-custom-green-mid' : 'bg-custom-green-light' }}"
                            data-href="{{ route('employees.show', $employee->id) }}">
                            <td class="text-center p-3" style="width: 11%;">{{ $employee->id }}</td>
                            <td class="name-logo py-3 px-3 d-flex align-items-center text-nowrap" style="width: 20%;">
                                <img class="logo rounded-circle flex-shrink-0 me-2" src="{{ $employee->logo_url }}" alt="Employee Logo" style="max-height: 40px; max-width: 40px;">
                                <span>{{ $employee->first_name . ' ' . $employee->last_name }}</span>
                            </td>
                            <td class="px-3 text-center">{{ $employee->email }}</td>
                            <td class="px-3 text-center">{{ $employee->phone }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination (keep sort state) -->
            <div class="mt-4">
                {{ $employees->appends(request()->only('sort_by', 'direction'))->links() }}
            </div>

        </div>
    </div>
@endsection