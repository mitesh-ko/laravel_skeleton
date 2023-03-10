<ul class="menu-inner py-1">
    @can(config('permission-name.dashboard-first_dashboard'))
        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" icon="ti-smart-home">
            {{ __('Dashboard') }}
        </x-nav-link>
    @endcan
    @canany([
        config('permission-name.user_management-list'),
        config('permission-name.user_management-create'),
        config('permission-name.user_management-update'),
        config('permission-name.user_management-delete'),
        ])
        <x-nav-link :href="route('users.index')"
                    :active="request()->routeIs(['users.index', 'users.edit', 'users.create'])"
                    icon="ti-users">
            {{ __('User') }}
        </x-nav-link>
    @endcanany

    @canany([
        config('constants.permissions.User management.List.name'),
        config('constants.permissions.User management.Create.name'),
        config('constants.permissions.User management.Delete.name'),
        config('constants.permissions.User management.Update.name'),
        ])
        <li class="menu-item active {{ request()->routeIs(['siteConfig', 'mailConfig', 'emailTemplate.index', 'emailTemplate.edit']) ? 'open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-settings"></i>
                <div data-i18n="Pages">Settings</div>
            </a>
            <ul class="menu-sub">
                @can(config('constants.permissions.Setting.Site Config.name'))
                    <x-nav-link :href="route('siteConfig')" :active="request()->routeIs('siteConfig')"
                                icon="ti-settings">
                        {{ __('General Setting') }}
                    </x-nav-link>
                @endcan
                @can(config('constants.permissions.Setting.Site Config.name'))
                    <x-nav-link :href="route('mailConfig')" :active="request()->routeIs('mailConfig')"
                                icon="ti-settings">
                        {{ __('Mail Setting') }}
                    </x-nav-link>
                @endcan
                @can(config('constants.permissions.Setting.Email template list.name'))
                    <x-nav-link :href="route('emailTemplate.index')"
                                :active="request()->routeIs(['emailTemplate.index', 'emailTemplate.edit'])"
                                icon="ti-template">
                        {{ __('Email Template') }}
                    </x-nav-link>
                @endcan
            </ul>
        </li>
    @endcanany

    @canany([
        config('constants.permissions.Logs.List audit logs.name'),
        config('constants.permissions.Logs.Audit log details.name'),
        config('constants.permissions.Logs.List authentication logs.name'),
        config('constants.permissions.Logs.Authentication log details.name'),
        ])
        <li class="menu-item active {{ request()->routeIs(['audits.index', 'audits.show', 'authenticationLogs.index']) ? 'open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-article"></i>
                <div data-i18n="Pages">Logs</div>
            </a>
            <ul class="menu-sub">
                @can(config('constants.permissions.Logs.List audit logs.name'))
                    <x-nav-link :href="route('audits.index')"
                                :active="request()->routeIs(['audits.index', 'audits.show'])"
                                icon="ti-article">
                        {{ __('Audit Logs') }}
                    </x-nav-link>
                @endcan
                @can(config('constants.permissions.Logs.List authentication logs.name'))
                    <x-nav-link :href="route('authenticationLogs.index')"
                                :active="request()->routeIs('authenticationLogs.index')"
                                icon="ti-article">
                        {{ __('Authentication Logs') }}
                    </x-nav-link>
                @endcan
            </ul>
        </li>
    @endcanany

    @canany([
        config('constants.permissions.Permission Management.List.name'),
        config('constants.permissions.Role Management.List.name'),
        config('constants.permissions.Role Management.Create.name'),
        config('constants.permissions.Role Management.Update.name'),
        config('constants.permissions.Role Management.Delete.name'),
        ])
        <li class="menu-item active {{ request()->routeIs(['roles.index', 'roles.create', 'roles.edit', 'permissions.list']) ? 'open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-shield-lock"></i>
                <div data-i18n="Pages">Manage access</div>
            </a>
            <ul class="menu-sub">
                @canany([
                    config('constants.permissions.Role Management.List.name'),
                    config('constants.permissions.Role Management.Create.name'),
                    config('constants.permissions.Role Management.Update.name'),
                    config('constants.permissions.Role Management.Delete.name'),
                ])
                    <x-nav-link :href="route('roles.index')"
                                :active="request()->routeIs(['roles.index', 'roles.create', 'roles.edit'])">
                        {{ __('Role') }}
                    </x-nav-link>
                @endcanany
                @can(config('constants.permissions.Permission Management.List.name'))
                    <x-nav-link :href="route('permissions.list')" :active="request()->routeIs('permissions.list')">
                        {{ __('Permission') }}
                    </x-nav-link>
                @endcan
            </ul>
        </li>
    @endcanany

    <li class="menu-item active {{ request()->routeIs(['profile', 'account']) ? 'open' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons ti ti-edit"></i>
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
