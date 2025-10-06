@extends('layouts.app')

@section('content')
    <x-page-header><a class="heading nav-link d-inline" href="{{ route('employees.index') }}">Employees</a> / {{ $employee->first_name }} {{ $employee->last_name }}</x-page-header>

    <div class="container">
        <div class="d-flex flex-column my-5 text-white bg-custom-green p-4 rounded">
            <h3 class="text-center text-sm-start mt-sm-3 ms-sm-3 fs-1">{{ $employee->first_name }} {{ $employee->last_name }}</h3>
            <div class="d-flex flex-column flex-sm-row align-items-center mb-4 my-sm-4 flex-nowrap">
                <img class="rounded-circle m-4" src="{{ $employee->logo_url }}" alt="Employee Logo" style="max-width: 130px; max-height: 130px;">
                <div class="details ms-sm-3 fs-5">
                    @if ($employee->id)
                        <p>Employee ID: {{ $employee->id }}</p>
                    @endif
                    @if ($employee->email)
                        <p>Email: <a class="underline nav-link d-inline" href="mailto:{{ $employee->email }}" target="_blank">{{ $employee->email }}</a></p>
                    @endif
                    @if ($employee->phone)
                        <p>Phone: {{ $employee->phone }}</p>
                    @endif
                    @if ($employee->company->name)
                        <p>Affiliated Company: <a class="underline nav-link d-inline" href="{{ $employee->company->id }}">{{ $employee->company->name }}</p></a>
                    @endif
                </div>
            </div>

            <div class="dates mt-sm-3 ms-sm-3 text-center text-sm-start fs-5">
                <p>Created on {{ $employee->created_at->format('jS F Y') }}</p>
                @if ($employee->created_at != $employee->updated_at)
                    <p>Updated on {{ $employee->updated_at->format('jS F Y') }}</p>
                @endif
            </div>
        
            <div class="buttons border-top border-custom-green-light pt-3 mt-3 px-2 w-100 d-flex justify-content-between">
                <x-button href="{{ route('employees.index') }}">Back</x-button>
                <x-button href="{{ route('employees.edit', $employee->id) }}">Edit</x-button>
                <form method="POST" class="deleteForm" action="{{ route('employees.destroy', $employee) }}" data-name="{{ $employee->first_name }} {{ $employee->last_name }}">
                    @csrf
                    @method('DELETE')
                    <x-button type="submit">Delete</x-button>
                </form>
            </div>
        </div>
    </div>    
@endsection