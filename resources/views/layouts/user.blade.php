<li class="nav-item navbar-dropdown dropdown-user dropdown">
    <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0)"
       data-bs-toggle="dropdown">
        <div class="avatar avatar-online">
            <img src="/assets/img/profile_placeholder.jpg" alt class="h-auto rounded-circle"/>
        </div>
    </a>
    <ul class="dropdown-menu dropdown-menu-end">
        <li>
            <a class="dropdown-item" href="{{ route('account') }}">
                <div class="d-flex">
                    <div class="flex-shrink-0 me-3">
                        <div class="avatar avatar-online">
                            <img src="/assets/img/profile_placeholder.jpg" alt
                                 class="h-auto rounded-circle"/>
                        </div>
                    </div>
                    <div class="flex-grow-1">
                        <span class="fw-semibold d-block">{{ auth()->user()->name }}</span>
                        <small class="text-muted">{{ auth()->user()->roles[0] ?? 'Role not assigned' }}</small>
                    </div>
                </div>
            </a>
        </li>
        <li>
            <div class="dropdown-divider"></div>
        </li>
        <li>
            <a class="dropdown-item" href="{{ route('profile') }}">
                <i class="ti ti-user-check me-2 ti-sm"></i>
                <span class="align-middle">My Profile</span>
            </a>
        </li>
        <li>
            <a class="dropdown-item" href="javascript:void(0)">
                <i class="ti ti-settings me-2 ti-sm"></i>
                <span class="align-middle"><del>Settings</del></span>
            </a>
        </li>
        <li>
            <a class="dropdown-item" href="javascript:void(0)">
                <span class="d-flex align-items-center align-middle">
                  <i class="flex-shrink-0 ti ti-credit-card me-2 ti-sm"></i>
                    <span class="flex-grow-1 align-middle"><del>Billing</del></span>
                  <span class="flex-shrink-0 badge badge-center rounded-pill bg-label-danger w-px-20 h-px-20"
                  >2</span
                  >
                </span>
            </a>
        </li>
        <li>
            <div class="dropdown-divider"></div>
        </li>
        <li>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                        this.closest('form').submit();">
                    <i class="ti ti-logout me-2 ti-sm"></i>
                    <span class="align-middle">Log Out</span>
                </a>
            </form>
        </li>
    </ul>
</li>
