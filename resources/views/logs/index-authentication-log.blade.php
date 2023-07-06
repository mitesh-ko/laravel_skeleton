<x-app-layout>
    <link rel="stylesheet" href="/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css"/>
    <link rel="stylesheet" href="/assets/vendor/libs/select2/select2.css" />
    <x-slot name="header">
        {{ __('Authentication Logs') }}
    </x-slot>
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">

            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 d-none">
                            <div class="row g-3">
                                <div class="col-12 col-sm-6 col-lg-4">
                                    <label class="form-label">User:</label>
                                    <select id="search-user" class="select2 form-control" data-allow-clear="true">
                                        <option value="">Select a user</option>
                                        @foreach($users ?? [] as $key => $user)
                                            <option value="{{ $key }}">{{ $user }}</option>
                                        @endforeach
                                    </select>
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
                    <table class="authentication_table table" data-url="{{ route('authenticationLogs.index') }}">
                        <thead>
                        <tr>
                            <th>Auth Model</th>
                            <th>User</th>
                            <th>IP</th>
                            <th>User Agent</th>
                            <th>Login at</th>
                            <th>Login successful</th>
                            <th>Logout at</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>

            <div class="content-backdrop fade"></div>
        </div>
    </div>
    <script src="/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script>
    <script src="/assets/vendor/libs/select2/select2.js"></script>
    @vite(['resources/js/assets/index-authentication.js'])
</x-app-layout>
