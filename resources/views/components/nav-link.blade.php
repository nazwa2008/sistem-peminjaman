@props(['active', 'icon'])

@php
$classes = ($active ?? false)
            ? 'flex items-center gap-3 px-3 py-2 text-sm font-medium text-primary-600 bg-primary-50 rounded-lg transition-colors group'
            : 'flex items-center gap-3 px-3 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-lg transition-colors group';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    <i data-lucide="{{ $icon }}" class="w-5 h-5 {{ ($active ?? false) ? 'text-primary-600' : 'text-gray-400 group-hover:text-gray-600' }}"></i>
    {{ $slot }}
</a>
