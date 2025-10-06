<div class="bg-custom-green">
    <div class="container d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-4 ">
        <h1 class="text-white fs-1 mb-2 mb-sm-0 ms-2">{{ $slot }}</h1>
        <div class="flex-wrap">
            <div class="ms-2 d-flex flex-nowrap gap-2 text-nowrap">
                <x-button href="{{ route('companies.create') }}">Create Company</x-button>
                <x-button href="{{ route('employees.create') }}">Create Employee</x-button>
            </div>
        </div>
    </div>
</div>