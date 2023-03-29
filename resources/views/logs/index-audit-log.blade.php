<x-app-layout>
    <link rel="stylesheet" href="/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css"/>
    <link rel="stylesheet" href="/assets/vendor/libs/flatpickr/flatpickr.css"/>
    <x-slot name="header">
        {{ __('Audits') }}
    </x-slot>
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">

            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="row g-3">
                                <div class="col-12 col-sm-6 col-lg-4">
                                    <label class="form-label">Model:</label>
                                    <select id="search-model" class="form-control">
                                        <option value="">Select a model</option>
                                        <option value="App\Models\User">User</option>
                                        <option value="App\Models\Role">Role</option>
                                        <option value="App\Models\EmailTemplate">Email Template</option>
                                        <option value="App\Models\SiteConfig">Site Config</option>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-6 col-lg-4">
                                    <label class="form-label">Action:</label>
                                    <select id="search-action" class="form-control">
                                        <option value="">Select a action</option>
                                        <option value="created">Created</option>
                                        <option value="updated">Updated</option>
                                        <option value="deleted">Deleted</option>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-6 col-lg-4">
                                    <label class="form-label">IP:</label>
                                    <input id="search-ip" type="ip" class="form-control"/>
                                </div>
                            </div>
                            <div class="mt-2">
                                <div class="col-12 col-sm-6 col-lg-4">
                                    <button id="search-request" class="btn btn-sm btn-primary"><i class="ti ti-search"></i></button>
                                    <button id="clear-search" class="btn btn-sm btn-primary"><i class="ti ti-clear-all"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="mt-0"/>
                <div class="card-datatable table-responsive">
                    <table class="audit_table table" data-url="{{ route('audits.index') }}">
                        <thead>
                        <tr>
                            <th>Time</th>
                            <th>User</th>
                            <th>Model</th>
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
