<x-app-layout>
    <link rel="stylesheet" href="/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css"/>
    <link rel="stylesheet" href="/assets/vendor/libs/flatpickr/flatpickr.css"/>
    <x-slot name="header">
        {{ __('Users List') }}
    </x-slot>
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">

            <div class="card">
                <div class="card-header">
                    <div class="text-end pt-3 pt-md-0">
                        <a class="btn btn-success" href="{{ route('users.create') }}">
                            <span>
                                <i class="ti ti-plus me-sm-1"></i>
                                <span class="d-none d-sm-inline-block">Add New User</span>
                            </span>
                        </a>
                    </div>
                </div>
                <!--Search Form -->
                <div class="card-body">
                    <form class="user-search" method="POST" data-url="{{ route('users.index') }}">
                        <div class="row">
                            <div class="col-12">
                                <div class="row g-3">
                                    <div class="col-12 col-sm-6 col-lg-4">
                                        <label class="form-label">Name:</label>
                                        <input
                                            type="text"
                                            class="form-control dt-input dt-full-name"
                                            data-column="1"
                                            placeholder="User name"
                                            data-column-index="0"
                                        />
                                    </div>
                                    <div class="col-12 col-sm-6 col-lg-4">
                                        <label class="form-label">Email:</label>
                                        <input
                                            type="text"
                                            class="form-control dt-input email"
                                            data-column="2"
                                            placeholder="user@example.com"
                                            data-column-index="1"
                                        />
                                    </div>
                                    <div class="col-12 col-sm-6 col-lg-4">
                                        <label class="form-label">Joining date:</label>
                                        <div class="mb-0">
                                            <input
                                                type="text"
                                                class="form-control dt-date flatpickr-range dt-input"
                                                data-column="5"
                                                placeholder="StartDate to EndDate"
                                                data-column-index="4"
                                                name="dt_date"
                                            />
                                            <input
                                                type="hidden"
                                                class="form-control dt-date start_date dt-input"
                                                data-column="5"
                                                data-column-index="4"
                                                name="value_from_start_date"
                                            />
                                            <input
                                                type="hidden"
                                                class="form-control dt-date end_date dt-input"
                                                name="value_from_end_date"
                                                data-column="5"
                                                data-column-index="4"
                                            />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <hr class="mt-0"/>
                <div class="card-datatable table-responsive">
                    <table class="audit_table table" data-url="{{ route('audits.index') }}">
                        <thead>
                        <tr>
                            <th>Time</th>
                            <th>User</th>
                            <th>Module</th>
                            <th>Action</th>
                            <th>IP</th>
                            <th>View</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>

            <div class="content-backdrop fade"></div>
        </div>
    </div>
    <script src="/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script>
    <script src="/assets/vendor/libs/moment/moment.js"></script>
    <script src="/assets/vendor/libs/flatpickr/flatpickr.js"></script>
    @vite(['resources/js/assets/index-audit.js'])
</x-app-layout>