<ul class="menu-inner py-1">
    @can(config('permission-name.dashboard-first_dashboard'))
        <x-nav-link :href="route('firstDashboard')" :active="request()->routeIs('firstDashboard')" icon="ti-smart-home">
            {{ __('Dashboard') }}
        </x-nav-link>
    @endcan

    @can(config('permission-name.user_management-list'))
        <x-nav-link :href="route('users.index')"
                    :active="request()->routeIs(['users.index', 'users.edit', 'users.create'])" icon="ti-users">
            {{ __('User') }}
        </x-nav-link>
    @endcan

    @can(config('permission-name.transaction-list'))
        <x-nav-link :href="route('transactions.index')"
                    :active="request()->routeIs(['transactions.index', 'transactions.edit', 'transactions.create'])" icon="ti-users">
            {{ __('Transaction') }}
        </x-nav-link>
    @endcan

    @canany([
        config('permission-name.setting-site_config'),
        config('permission-name.setting-mail_settings'),
        config('permission-name.setting-email_template_list'),
        ])
        <li class="menu-item active {{ request()->routeIs(['siteConfig', 'mailConfig', 'emailTemplate.index', 'emailTemplate.edit']) ? 'open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-settings"></i>
                <div data-i18n="Pages">Settings</div>
            </a>
            <ul class="menu-sub">
                @can(config('permission-name.setting-site_config'))
                    <x-nav-link :href="route('siteConfig')" :active="request()->routeIs('siteConfig')"
                                icon="ti-settings">
                        {{ __('Site Config') }}
                    </x-nav-link>
                @endcan
                @can(config('permission-name.setting-mail_settings'))
                    <x-nav-link :href="route('mailConfig')" :active="request()->routeIs('mailConfig')"
                                icon="ti-settings">
                        {{ __('Mail Setting') }}
                    </x-nav-link>
                @endcan
                @can(config('permission-name.setting-email_template_list'))
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
        config('permission-name.logs-list_audit_logs'),
        config('permission-name.logs-list_authentication_logs'),
        ])
        <li class="menu-item active {{ request()->routeIs(['audits.index', 'audits.show', 'authenticationLogs.index']) ? 'open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-article"></i>
                <div data-i18n="Pages">Logs</div>
            </a>
            <ul class="menu-sub">
                @can(config('permission-name.logs-list_audit_logs'))
                    <x-nav-link :href="route('audits.index')"
                                :active="request()->routeIs(['audits.index', 'audits.show'])"
                                icon="ti-article">
                        {{ __('Audit Logs') }}
                    </x-nav-link>
                @endcan
                @can(config('permission-name.logs-list_authentication_logs'))
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
        config('permission-name.role_management-list'),
        config('permission-name.permission_management-list'),
        ])
        <li class="menu-item active {{ request()->routeIs(['roles.index', 'roles.create', 'roles.edit', 'permissions.list']) ? 'open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-shield-lock"></i>
                <div data-i18n="Pages">Manage access</div>
            </a>
            <ul class="menu-sub">
                @can(config('permission-name.role_management-list'))
                    <x-nav-link :href="route('roles.index')"
                                :active="request()->routeIs(['roles.index', 'roles.create', 'roles.edit'])">
                        {{ __('Role') }}
                    </x-nav-link>
                @endcan
                @can(config('permission-name.permission_management-list'))
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
