<x-app-layout>
    <link rel="stylesheet" href="/assets/vendor/libs/sweetalert2/sweetalert2.css"/>
    <link rel="stylesheet" href="/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css"/>
    <link rel="stylesheet" href="/assets/vendor/libs/flatpickr/flatpickr.css"/>
    <x-slot name="header">
        {{ __('Transactions') }}
    </x-slot>
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">

            <div class="card">
                <div class="card-header">
                    <div class="text-end pt-3 pt-md-0">
                        @can(config('permission-name.transaction-create'))
                            <a class="btn btn-success" href="{{ route('transactions.create') }}">
                            <span>
                                <i class="ti ti-plus me-sm-1"></i>
                                <span class="d-none d-sm-inline-block">Transaction</span>
                            </span>
                            </a>
                        @endcan
                    </div>
                </div>
                <!--Search Form -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="row g-3 mb-2">
                                <div class="col-12 col-sm-6 col-lg-3">
                                    <label for="type" class="form-label">Type:</label>
                                    <select class="form-control" id="search-type">
                                        <option value=""></option>
                                        <option value="1">Income</option>
                                        <option value="2">Expanse</option>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-6 col-lg-3">
                                    <label for="search-amount" class="form-label">Amount: <!--(Use <, >, to search less than or greater than amount) --></label>
                                    <input id="search-amount" type="number" min="1" class="form-control" placeholder="500"/>
                                </div>
                                <div class="col-12 col-sm-6 col-lg-3">
                                    <label for="search-date" class="form-label">Date:</label>
                                    <input id="search-date" type="date" class="form-control"/>
                                </div>
                                <div class="col-12 col-sm-6 col-lg-3">
                                    <label for="search-status" class="form-label">Status:</label>
                                    <select class="form-control" id="search-status">
                                        <option value=""></option>
                                        <option value="1">Paid</option>
                                        <option value="2">Unpaid</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row g-3">
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
                    <table class="transaction-list-table table" data-url="{{ route('transactions.index') }}">
                        <thead>
                        <tr>
                            <th>Type</th>
                            <th>Amount</th>
                            <th>Date</th>
                            <th>Desc</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>

            <div class="content-backdrop fade"></div>
        </div>
    </div>
    <script src="/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script>
    <script src="/assets/vendor/libs/sweetalert2/sweetalert2.js"></script>
    <script src="/assets/vendor/libs/moment/moment.js"></script>
    <script src="/assets/vendor/libs/flatpickr/flatpickr.js"></script>
    @vite(['resources/js/assets/index-transaction.js'])
</x-app-layout>
