@props(['active'])

@php
    $classes = ($active ?? false)
                ? 'bg-gradient-to-r from-gray-800 to-gray-900 text-b rounded-full'
                : 'hover:bg-gradient-to-r hover:from-gray-800 hover:to-gray-900 rounded-full transition duration-200 ease-in-out';
@endphp

<a {{ $attributes->class(['block p-3'])->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
