@props(['color' => 'default'])

@php
    $colors = [
        'default' => 'bg-blue-500 border-blue-500',
        'blue' => 'bg-blue-500 border-blue-500',
        'green' => 'bg-emerald-500 border-emerald-500 ',
        'yellow' => 'bg-yellow-500 border-yellow-500 ',
    ]
@endphp

<div
    {{ $attributes->merge(['class' => 'px-2 py-0.5 text-sm border rounded-xl ' . $colors[$color]  ]) }}>
    {{ $slot }}
</div>
