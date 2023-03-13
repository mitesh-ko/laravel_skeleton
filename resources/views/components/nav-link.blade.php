@props(['active'])
@props(['href'])
@props(['icon'])

@php
$classes = ($active ?? false)
            ? 'menu-item active pe-none'
            : 'menu-item';
@endphp

<li class="{{ $classes }}">
    <a class="menu-link" href="{{ $href }}">
        <i class="menu-icon tf-icons ti {{ $icon ?? '' }}"></i>
        <div data-i18n="Page 2">{{ $slot }}</div>
    </a>
</li>
