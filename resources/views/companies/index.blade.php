@extends('layouts.app')

@section('content')
    <x-page-header>Companies</x-page-header>

    <div class="container mt-5">
        <div class="rounded overflow-auto">
            <table class="w-100 rounded">
                <thead>
                    <tr class="text-white bg-custom-green-light text-center fs-5">
                        <th class="py-3">
                            <a href="{{ route('companies.index', ['sort_by' => 'name', 'direction' => $sortField === 'name' && $sortDirection === 'asc' ? 'desc' : 'asc']) }}"
                            class="text-white text-decoration-none">
                                Name
                                @if ($sortField === 'name')
                                    <span>{{ $sortDirection === 'asc' ? '▲' : '▼' }}</span>
                                @endif
                            </a>
                        </th>

                        <th>
                            <a href="{{ route('companies.index', ['sort_by' => 'employees_count', 'direction' => $sortField === 'employees_count' && $sortDirection === 'asc' ? 'desc' : 'asc']) }}"
                            class="text-white text-decoration-none">
                                Employees
                                @if ($sortField === 'employees_count')
                                    <span>{{ $sortDirection === 'asc' ? '▲' : '▼' }}</span>
                                @endif
                            </a>
                        </th>

                        <th>
                            <a href="{{ route('companies.index', ['sort_by' => 'email', 'direction' => $sortField === 'email' && $sortDirection === 'asc' ? 'desc' : 'asc']) }}"
                            class="text-white text-decoration-none">
                                Email
                                @if ($sortField === 'email')
                                    <span>{{ $sortDirection === 'asc' ? '▲' : '▼' }}</span>
                                @endif
                            </a>
                        </th>

                        <th>
                            <a href="{{ route('companies.index', ['sort_by' => 'website', 'direction' => $sortField === 'website' && $sortDirection === 'asc' ? 'desc' : 'asc']) }}"
                            class="text-white text-decoration-none">
                                Website
                                @if ($sortField === 'website')
                                    <span>{{ $sortDirection === 'asc' ? '▲' : '▼' }}</span>
                                @endif
                            </a>
                        </th>

                        <th>
                            <a href="{{ route('companies.index', ['sort_by' => 'updated_at', 'direction' => $sortField === 'updated_at' && $sortDirection === 'asc' ? 'desc' : 'asc']) }}"
                            class="text-white text-decoration-none">
                                Last Update
                                @if ($sortField === 'updated_at')
                                    <span>{{ $sortDirection === 'asc' ? '▲' : '▼' }}</span>
                                @endif
                            </a>
                        </th>
                    </tr>
                </thead>
                <tbody class="fs-5">
                    @foreach ($companies as $company)
                        <tr class="clickable-row text-white {{ $loop->odd ? 'bg-custom-green-mid' : 'bg-custom-green-light' }}" data-href="{{ route('companies.show', $company->id) }}">
                            <td class="name-logo py-3 px-3 d-flex align-items-center text-nowrap">
                                <div class="d-flex align-items-center justify-content-center me-2 bg-white rounded-circle flex-shrink-0" style="width: 40px; height: 40px;">
                                    <img class="logo rounded-circle flex-shrink-0" src="{{ $company->logo_url }}" alt="Company Logo" style="height: 30px; width: 30px;">
                                </div>
                                <span>{{ $company->name }}</span>
                            </td>
                            {{-- use preloaded employees_count (no extra query) --}}
                            <td class="px-3 text-center">{{ $company->employees_count }}</td>
                            <td class="px-3 text-center">{{ $company->email }}</td>
                            <td class="px-3 text-center">{{ parse_url($company->website, PHP_URL_HOST) ?? $company->website }}</td>
                            <td class="px-3 text-center text-nowrap">{{ $company->updated_at->format('M d, Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-5">
            {{ $companies->appends(request()->only('sort_by','direction'))->links() }}
        </div>
    </div>

@endsection