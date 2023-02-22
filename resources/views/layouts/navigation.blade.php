<ul class="menu-inner py-1">
    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
        {{ __('Dashboard') }}
    </x-nav-link>
    <x-nav-link :href="route('siteConfig')" :active="request()->routeIs('siteConfig')">
        {{ __('Site Config') }}
    </x-nav-link>
    <x-nav-link :href="route('users.index')" :active="request()->routeIs(['users.index', 'users.edit'])">
        {{ __('User') }}
    </x-nav-link>
    <x-nav-link :href="route('emailTemplate.index')" :active="request()->routeIs(['emailTemplate.index', 'emailTemplate.edit'])">
        {{ __('Email Template') }}
    </x-nav-link>
    <li class="menu-item active open">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons ti ti-file"></i>
            <div data-i18n="Pages">Manage access</div>
        </a>
        <ul class="menu-sub">
            <x-nav-link :href="route('roles.index')" :active="request()->routeIs(['roles.index', 'roles.edit'])">
                {{ __('Role') }}
            </x-nav-link>
            <x-nav-link :href="route('permissions.list')" :active="request()->routeIs('permissions.list')">
                {{ __('Permission') }}
            </x-nav-link>
        </ul>
    </li>
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
