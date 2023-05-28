<button {{ $attributes->merge(['type' => 'submit', 'class' => 'border border-transparent']) }}>
    {{ $slot }}
</button>
