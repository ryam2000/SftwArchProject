@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'focus:border-emerald-500 focus:ring-0 text-sm']) !!}>
