<ul class="menu-inner py-1">
    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
        {{ __('Dashboard') }}
    </x-nav-link>
    <x-nav-link :href="route('siteConfig')" :active="request()->routeIs('siteConfig')">
        {{ __('Site Config') }}
    </x-nav-link>
    <li class="menu-item active open">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons ti ti-file"></i>
            <div data-i18n="Pages">Myself</div>
        </a>
        <ul class="menu-sub">
            <x-nav-link :href="route('profile')" :active="request()->routeIs('profile')">
                {{ __('Profile') }}
            </x-nav-link>
            <x-nav-link :href="route('account')" :active="request()->routeIs('account')">
                {{ __('Account') }}
            </x-nav-link>
        </ul>
    </li>
</ul>
