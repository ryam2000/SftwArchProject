@props(['active'])

<a {{ $attributes->class(['inline-flex items-center rounded-full px-4 py-2 bg-gray-900 border border-transparent text-xs text-white tracking-widest hover:bg-gray-700 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</a>
