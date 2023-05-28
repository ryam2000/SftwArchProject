<button {{ $attributes->merge(['type' => 'submit', 'class' => 'flex flex-row w-full pt-4 pl-4 bg-gray-900 border-0 border-b border-gray-600 hover:bg-gray-800 transition ease-in-out duration-200']) }}>
    {{ $slot }}
</button>
