@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 text-sm leading-5 bg-gray-600 text-white h-11 focus:outline-none dark:focus:border-gray-700 transition duration-150 ease-in-out'
            : 'inline-flex items-center px-1 pt-1 text-sm leading-5 text-white text-gray-300 hover:text-base focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
