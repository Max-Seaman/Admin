@props(['active' => false, 'type' => 'a'])

@php
    $classes = $active
        ? 'text-white'
        : 'text-custom-green-txt fw-medium custom-hover';
@endphp

@if($type === 'a')
    <a {{ $attributes->merge(['class' => "nav-link rounded px-3 py-2 $classes"]) }}>
        {{ $slot }}
    </a>
@else
    <button {{ $attributes->merge(['class' => "btn rounded px-3 py-2 $classes"]) }}>
        {{ $slot }}
    </button>
@endif
