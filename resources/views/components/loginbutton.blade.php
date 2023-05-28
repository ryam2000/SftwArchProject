@props(['active'])

<a {{ $attributes->class(['rounded-full p-3 bg-gray-900 border border-transparent text-white hover:bg-gray-800 active:bg-gray-800 focus:bg-gray-800 transition ease-in-out duration-200']) }}>
    {{ $slot }}
</a>
