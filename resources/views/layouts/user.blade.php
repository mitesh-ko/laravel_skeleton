<li class="nav-item navbar-dropdown dropdown-user dropdown">
    <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0)"
       data-bs-toggle="dropdown">
        <div class="avatar avatar-online">
            <img src="{{ auth()->user()->profile ?? '/assets/img/profile_placeholder.jpg' }}" alt="profile"
                 class="rounded-circle h-px-40 w-px-40" style="object-fit: cover"/>
        </div>
    </a>
    <ul class="dropdown-menu dropdown-menu-end">
        <li>
            <a class="dropdown-item" href="{{ route('account') }}">
                <div class="d-flex">
                    <div class="flex-shrink-0 me-3">
                        <div class="avatar avatar-online">
                            <img src="{{ auth()->user()->profile ?? '/assets/img/profile_placeholder.jpg' }}"
                                 alt="profile"
                                 class="rounded-circle h-px-40 w-px-40" style="object-fit: cover"/>
                        </div>
                    </div>
                    <div class="flex-grow-1">
                        <span class="fw-semibold d-block">{{ auth()->user()->name }}</span>
                        <small class="text-muted">{{ auth()->user()->roles[0]?->name ?? 'Role not assigned' }}</small>
                    </div>
                </div>
            </a>
        </li>
        <li>
            <div class="dropdown-divider"></div>
        </li>
        <li>
            <span class="mx-4" href="javascript:void(0)">
                <i class="ti me-2 ti-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-password" width="24"
                         height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                         stroke-linecap="round" stroke-linejoin="round">
                       <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                       <path d="M12 10v4"></path>
                       <path d="M10 13l4 -2"></path>
                       <path d="M10 11l4 2"></path>
                       <path d="M5 10v4"></path>
                       <path d="M3 13l4 -2"></path>
                       <path d="M3 11l4 2"></path>
                       <path d="M19 10v4"></path>
                       <path d="M17 13l4 -2"></path>
                       <path d="M17 11l4 2"></path>
                    </svg>
                </i>
                <span class="align-middle">Support pin: </span>
                @if(auth()->user()->support_pin)
                    <span class="align-middle text-info">{{ auth()->user()->support_pin }}</span>
                @else
                    <a class="align-middle text-success" href="{{ route('account') }}">Get</a>
                @endif
            </span>
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
