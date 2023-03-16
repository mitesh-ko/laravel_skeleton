<x-app-layout>
    <x-slot name="header">
        {{ isset($role) ? __('Update role') : __('Create new role') }}
    </x-slot>
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">

            <div class="card mb-4">
                <div class="card-body">
                    <form id="roleCreateUpdate" method="POST"
                          action="{{ isset($role) ? route('roles.update', $role->id) :  route('roles.store') }}">
                        @csrf
                        @isset($role)
                            @method('PUT')
                        @endif
                        <div class="col-6 mb-4 form-input">
                            <label class="form-label" for="modalRoleName">Role Name</label>
                            <input type="text" name="role_name" class="form-control" placeholder="Enter a role name"
                                   autofocus value="{{ old('role_name', $role->name ?? '') }}"/>
                        </div>
                        <div class="col-12">
                            <h5>Role Permissions</h5>
                            <!-- Permission table -->
                            <div class="table-responsive">
                                <table class="table table-flush-spacing">
                                    <tbody>
                                    <tr>
                                        <td class="text-nowrap fw-semibold">
                                            Administrator Access
                                            <i class="ti ti-info-circle" data-bs-toggle="tooltip"
                                               data-bs-placement="top" title="Allows a full access to the system">
                                            </i>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="selectAll"/>
                                                <label class="form-check-label" for="selectAll"> Select All </label>
                                            </div>
                                        </td>
                                    </tr>
                                    @foreach(config('constants.permissions') as $key => $value)
                                        <tr>
                                            <td class="text-nowrap fw-semibold">{{ $key }}</td>
                                            <td class="row-permission-checkbox">
                                                <div class="d-flex">
                                                    <div class="form-check me-3 me-lg-3">
                                                        <input class="form-check-input select-row" type="checkbox">
                                                        <label class="form-check-label">All
                                                            <img src="/assets/img/Icon ionic-ios-arrow-dropleft.svg"
                                                                 width="14px" class="mb-1">
                                                        </label>
                                                    </div>
                                                    @foreach(config('constants.permissions.' . $key) as $value2)
                                                        <div class="form-check me-3 me-lg-5 form-input"
                                                             style="margin-left: {{ $value2['marginLeft'] }}px">
                                                            <input class="form-check-input permission-checkbox" type="checkbox"
                                                                   id="{{ $value2['name'] }}"
                                                                   name="permissions[{{ $value2['name'] }}]"
                                                                   value="{{ $value2['name'] }}"
                                                                @checked(isset($role) && $role->hasPermissionTo($value2['name'])) />
                                                            <label class="form-check-label"
                                                                   for="{{ $value2['name'] }}">{{ $value2['displayName'] }}</label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- Permission table -->
                        </div>
                        <div class="col-12 text-center mt-4">
                            <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
                            <a class="btn btn-label-secondary" href="{{ route('roles.index') }}">Cancel</a>
                        </div>
                    </form>
                </div>
                <!-- /Account -->
            </div>
            <div class="content-backdrop fade"></div>
        </div>
    </div>
    <script src="/assets/vendor/libs/form-validation/dist/js/FormValidation.min.js"></script>
    <script src="/assets/vendor/libs/form-validation/dist/js/plugins/Bootstrap5.min.js"></script>
    <script src="/assets/vendor/libs/form-validation/dist/js/plugins/AutoFocus.min.js"></script>
    @vite(['resources/js/assets/create-update-role.js'])
</x-app-layout>
