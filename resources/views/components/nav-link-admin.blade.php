@props(['active'])

@php
    $classes = ($active ?? false)
                ? 'bg-white text-black'
                : 'hover:bg-white hover:text-black transition duration-200 ease-in-out';
@endphp

<a {{ $attributes->class(['block py-2'])->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
