@extends('layouts.app')

@section('content')
    <x-page-header>
        <a class="underline nav-link d-inline" href="{{ route('companies.index') }}">Companies</a> / Edit
    </x-page-header>

    <div class="container mt-5">
        <form method="POST" action="{{ route('companies.update', $company->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div class="bg-custom-green p-5 rounded shadow-lg">
                <h3 class="text-white mb-4">Edit Company Details</h3>

                <div class="row g-4">
                    {{-- Name --}}
                    <div class="col-md-6">
                        <x-form-label for="name">Name</x-form-label>
                        <x-form-input type="text" name="name" value="{{ old('name', $company->name) }}" class="form-control" />
                        <x-form-error :messages="$errors->get('name')" class="text-warning small" />
                    </div>

                    {{-- Email --}}
                    <div class="col-md-6">
                        <x-form-label for="email">Email</x-form-label>
                        <x-form-input type="email" name="email" value="{{ old('email', $company->email) }}" class="form-control" />
                        <x-form-error :messages="$errors->get('email')" class="text-warning small" />
                    </div>

                    {{-- Website --}}
                    <div class="col-md-6">
                        <x-form-label for="website">Website</x-form-label>
                        <x-form-input type="text" name="website" value="{{ old('website', $company->website) }}" class="form-control" />
                        <x-form-error :messages="$errors->get('website')" class="text-warning small" />
                    </div>

                    {{-- Logo --}}
                    <div class="col-md-6">
                        <x-form-label for="logo">Logo</x-form-label>
                        <x-form-input name="logo" type="file" class="form-control bg-custom-green-dark" />
                        <x-form-error :messages="$errors->get('logo')" class="text-warning small" />
                    </div>
                </div>

                {{-- Update button --}}
                <div class="d-flex justify-content-between mt-5">
                    <x-button href="{{ route('companies.show', $company->id) }}">Back</x-button>
                    <x-button type="submit">Update</x-button>
                </div>
            </div>
        </form>
    </div>
@endsection
