<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center px-4 py-2 bg-emerald-500 border border-transparent rounded-full text-xs text-gray-900 tracking-widest hover:bg-gray-500 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
