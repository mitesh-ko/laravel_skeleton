<x-app-layout>
    <x-slot name="header">
        Audit Detail of module <span class="badge">{{ $audit->auditable_type }}</span>
    </x-slot>
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">

            <div class="card mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive border">
                                <table class="table m-0">
                                    <tbody>
                                    <tr>
                                        <td class="text-nowrap">User Type<span class="badge text-info">:</span></td>
                                        <td class="text-nowrap">{{ $audit->user_type }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-nowrap">User <span class="badge text-info">:</span></td>
                                        <td class="text-nowrap">{{ $audit->user->name }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-nowrap">Module <span class="badge text-info">:</span></td>
                                        <td class="text-nowrap">{{ $audit->auditable_type }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-nowrap">Action <span class="badge text-info">:</span></td>
                                        <td class="text-nowrap">{{ $audit->event }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-nowrap">Time <span class="badge text-info">:</span></td>
                                        <td class="text-nowrap">{{ $audit->created_at }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-nowrap">URL <span class="badge text-info">:</span></td>
                                        <td class="text-nowrap">{{ $audit->url }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-nowrap">IP Address <span class="badge text-info">:</span></td>
                                        <td class="text-nowrap">{{ $audit->ip_address }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-nowrap">User Agent <span class="badge text-info">:</span></td>
                                        <td class="text-nowrap">{{ $audit->user_agent }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="col-md-6 my-2">
                            <span class="badge bg-warning mb-2">Old Value</span>
                            <div class="table-responsive border">
                                <table class="table m-0">
                                    <tbody>
                                    @foreach($audit->old_values as $key => $value)
                                        <tr>
                                            <td class="text-nowrap">{{ $key }} <span class="badge text-info">:</span>
                                            </td>
                                            <td class="text-nowrap">{{ json_encode($value) }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-6 my-2">
                            <span class="badge bg-success mb-2">New Value</span>
                            <div class="table-responsive border">
                                <table class="table m-0">
                                    <tbody>
                                    @foreach($audit->new_values as $key => $value)
                                        <tr>
                                            <td class="text-nowrap">{{ $key }} <span class="badge text-info">:</span>
                                            </td>
                                            <td class="text-nowrap">{{ json_encode($value) }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="mt-2">
                        <a class="btn btn-label-secondary" href="{{ route('audits.index') }}">Back</a>
                    </div>
                </div>
                <!-- /Account -->
            </div>
            <div class="content-backdrop fade"></div>
        </div>
    </div>
    <script src="/assets/vendor/libs/form-validation/dist/js/FormValidation.min.js"></script>
    <script src="/assets/vendor/libs/form-validation/dist/js/plugins/Bootstrap5.min.js"></script>
    <script src="/assets/vendor/libs/form-validation/dist/js/plugins/AutoFocus.min.js"></script>
    @vite(['resources/js/assets/account.js'])
</x-app-layout>
