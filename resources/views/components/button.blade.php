@php
$classes = ' text-white rounded px-3 py-2 d-inline-flex align-items-center justify-content-center bg-custom-green-mid custom-hover border-0 nav-link';
@endphp

@if(isset($attributes['href']))
    <a {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
@else
    <button {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </button>
@endif

