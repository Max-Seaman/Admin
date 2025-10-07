@extends('layouts.app')

@section('content')
    <x-page-header>
        <a class="underline nav-link d-inline" href="{{ route('employees.index') }}">Employees</a> / Edit
    </x-page-header>

    <div class="container mt-5">
        <form method="POST" action="{{ route('employees.update', $employee->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div class="bg-custom-green p-5 rounded shadow-lg">
                <h3 class="text-white mb-4">Employee Details</h3>

                <div class="row g-4">
                    {{-- First Name --}}
                    <div class="col-md-6">
                        <x-form-label for="first_name">First Name</x-form-label>
                        <x-form-input type="text" name="first_name" value="{{ old('first_name', $employee->first_name) }}" class="form-control" />
                        <x-form-error :messages="$errors->get('first_name')" class="text-warning small" />
                    </div>

                    {{-- Last Name --}}
                    <div class="col-md-6">
                        <x-form-label for="last_name">Last Name</x-form-label>
                        <x-form-input type="text" name="last_name" value="{{ old('last_name', $employee->last_name) }}" class="form-control" />
                        <x-form-error :messages="$errors->get('last_name')" class="text-warning small" />
                    </div>

                    {{-- Email --}}
                    <div class="col-md-6">
                        <x-form-label for="email">Email</x-form-label>
                        <x-form-input type="email" name="email" value="{{ old('email', $employee->email) }}" class="form-control" />
                        <x-form-error :messages="$errors->get('email')" class="text-warning small" />
                    </div>

                    {{-- Phone --}}
                    <div class="col-md-6">
                        <x-form-label for="phone">Phone</x-form-label>
                        <x-form-input type="text" name="phone" value="{{ old('phone', $employee->phone) }}" class="form-control" />
                        <x-form-error :messages="$errors->get('phone')" class="text-warning small" />
                    </div>

                    {{-- Company --}}
                    <div class="col-md-6">
                        <x-form-label for="company_id">Company</x-form-label>
                        <select name="company_id" id="company_id" class="form-select bg-custom-green-dark text-white border-0 p-2">
                            <option value="">Select Company</option>
                            @foreach ($companies as $company)
                                <option value="{{ $company->id }}" {{ old('company_id', $employee->company_id) == $company->id ? 'selected' : '' }}>
                                    {{ $company->name }}
                                </option>
                            @endforeach
                        </select>
                        <x-form-error :messages="$errors->get('company_id')" class="text-warning small" />
                    </div>
                </div>

                {{-- Save button --}}
                <div class="d-flex justify-content-between mt-5">
                    <x-button href="{{ route('employees.show', $employee->id) }}">Back</x-button>
                    <x-button type="submit">Update</x-button>
                </div>
            </div>
        </form>
    </div>
@endsection
