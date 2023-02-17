@props(['active'])
@props(['href'])

@php
$classes = ($active ?? false)
            ? 'menu-item active'
            : 'menu-item';
@endphp

<li class="{{ $classes }}">
    <a class="menu-link" href="{{ $href }}">
        <i class="menu-icon tf-icons ti ti-app-window"></i>
        <div data-i18n="Page 2">{{ $slot }}</div>
    </a>
</li>
