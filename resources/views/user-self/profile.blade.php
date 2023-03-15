<x-app-layout>
    @vite(['resources/css/assets/profile.css'])
    <x-slot name="header">
        {{ __('My Profile') }}
    </x-slot>
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">

            <!-- Header -->
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="user-profile-header-banner">
                            <img src="/assets/img/pages/profile-banner.png" alt="Banner image" class="rounded-top"/>
                        </div>
                        <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4">
                            <div class="flex-shrink-0 mt-n2 mx-sm-0 mx-auto">
                                <img src="/assets/img/profile_placeholder.jpg" alt="user image" style="box-shadow: 0 -0.75rem 1.25rem rgba(2, 0, 0, 0.4);"
                                     class="d-block h-auto ms-0 ms-sm-4 border-0 border rounded user-profile-img"/>
                            </div>
                            <div class="flex-grow-1 mt-3 mt-sm-5">
                                <div
                                    class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-4 flex-md-row flex-column gap-4"
                                >
                                    <div class="user-profile-info">
                                        <h4>{{ auth()->user()->name }}</h4>
                                        <ul
                                            class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-2"
                                        >
                                            {!! isset(auth()->user()->roles[0]) ? '<li class="list-inline-item"> <i class="ti ti-color-swatch"></i></li>' . auth()->user()->roles[0]?->name : '' !!}
                                            <li class="list-inline-item"><i class="ti ti-calendar mb-2"></i>
                                                Joined {{ \Carbon\Carbon::parse(auth()->user()->email_verified_at)->format('M Y') }}
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Header -->

            <!-- Navbar pills -->
            <div class="row">
                <div class="col-md-12">
                    <ul class="nav nav-pills flex-column flex-sm-row mb-4">
                        <li class="nav-item">
                            <a class="nav-link active" href="javascript:void(0);"
                            ><i class="ti-xs ti ti-user-check me-1"></i> Info</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="javascript:void(0);"
                            ><i class="ti-xs ti ti-users me-1"></i>
                                <del> Teams</del>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="javascript:void(0);"
                            ><i class="ti-xs ti ti-layout-grid me-1"></i>
                                <del> Projects</del>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <!--/ Navbar pills -->
            <div class="row">
                <div class="col-12">
                    <!-- About User -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <small class="card-text text-uppercase">About</small>
                            <ul class="list-unstyled mb-4 mt-3">
                                <li class="d-flex align-items-center mb-3">
                                    <i class="ti ti-user"></i><span class="fw-bold mx-2">Full Name:</span>
                                    <span>{{ auth()->user()->name }}</span>
                                </li>
                                <li class="d-flex align-items-center mb-3">
                                    <i class="ti ti-check"></i><span class="fw-bold mx-2">Status:</span>
                                    <span>Active</span>
                                </li>
                                <li class="d-flex align-items-center mb-3">
                                    <i class="ti ti-crown"></i><span class="fw-bold mx-2">Role:</span>
                                    <span>{{ auth()->user()->roles[0]?->name ?? 'Role not assigned' }}</span>
                                </li>
                                <li class="d-flex align-items-center mb-3">
                                    <i class="ti ti-flag"></i><span class="fw-bold mx-2">Country:</span>
                                    <span>USA</span>
                                </li>
                            </ul>
                            <small class="card-text text-uppercase">Contacts</small>
                            <ul class="list-unstyled mb-4 mt-3">
                                <li class="d-flex align-items-center mb-3">
                                    <i class="ti ti-phone-call"></i><span class="fw-bold mx-2">Contact:</span>
                                    <span>(123) 456-7890</span>
                                </li>
                                <li class="d-flex align-items-center mb-3">
                                    <i class="ti ti-brand-skype"></i><span class="fw-bold mx-2">Skype:</span>
                                    <span>john.doe</span>
                                </li>
                                <li class="d-flex align-items-center mb-3">
                                    <i class="ti ti-mail"></i><span class="fw-bold mx-2">Email:</span>
                                    <span>{{ auth()->user()->email }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!--/ About User -->
                </div>
            </div>
            <div class="content-backdrop fade"></div>
        </div>
    </div>
    @vite(['resources/js/assets/profile.js'])
</x-app-layout>
