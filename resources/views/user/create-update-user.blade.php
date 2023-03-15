<x-app-layout>
    <x-slot name="header">
        {{  isset($user) ? __('Update user') : __('Create new user') }}
    </x-slot>
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">

            <div class="card mb-4">
                <!-- Account -->
                <div class="card-body">
                    <form id="formAccountSettings" method="POST" enctype="multipart/form-data"
                          action="{{ isset($user) ? route('users.update', $user->id) :  route('users.store') }}">
                        @csrf
                        @isset($user)
                            @method('PUT')
                        @endif
                        <div class="row">
                            <div class="d-flex align-items-start align-items-sm-center gap-4 mb-3">
                                <img src="{{ $user->profile ?? '/assets/img/profile_placeholder.jpg'}}" alt="user-avatar"
                                     class="d-block w-px-100 h-px-100 rounded" id="uploadedAvatar"/>
                                <div class="button-wrapper">
                                    <label for="upload" class="btn btn-primary me-2 mb-3" tabindex="0">
                                        <span class="d-none d-sm-block">Upload new photo</span>
                                        <i class="ti ti-upload d-block d-sm-none"></i>
                                        <input type="file" id="upload" name="profile" class="account-file-input" hidden
                                               accept="image/png, image/jpeg"/>
                                    </label>
                                    <button type="button" class="btn btn-label-secondary account-image-reset mb-3">
                                        <i class="ti ti-refresh-dot d-block d-sm-none"></i>
                                        <span class="d-none d-sm-block">Reset</span>
                                    </button>
                                    <div class="text-muted">Allowed JPG, GIF or PNG. Max size of 800K</div>
                                </div>
                            </div>
                            <hr class="mb-0">
                            <div style="padding-left: 0"><span class="badge bg-success mb-2">username : {{ $user->username }}</span></div>
                            <div class="mb-3 col-md-6">
                                <label for="firstName" class="form-label">Full Name</label>
                                <input class="form-control" type="text" id="name" name="name"
                                       placeholder="User full name" value="{{ old('user', $user->name ?? '') }}"
                                       autofocus/>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="email" class="form-label">E-mail</label>
                                @isset($user)
                                    {!! $user->email_verified_at ? '<span class="badge text-success">email verified.</span>' : '<span class="badge text-danger">email not verified!</span>'!!}
                                @endisset
                                <input class="form-control" type="text" id="email" name="email"
                                       value="{{ old('user', $user->email ?? '') }}" placeholder="user@example.com"/>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="phoneNumber">Phone Number</label>
                                @isset($user)
                                    {!! $user->phone ? ($user->phone_verified_at ? '<span class="badge text-success">phone verified.</span>' : '<span class="badge text-danger">phone not verified!</span>') : '' !!}
                                @endisset
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text">IN (+91)</span>
                                    <input type="text" id="phoneNumber" name="phone" class="form-control"
                                           value="{{ old('user', $user->phone ?? '') }}"/>
                                </div>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="role">Role</label>
                                <div class="input-group">
                                    <select id="role" name="role" class="form-control" required>
                                        <option value="">Select a role</option>
                                        @foreach(\App\Models\Role::get() as $role)
                                            <option
                                                value="{{ $role->name }}" @selected(old('role', $user->roles[0]->name ?? '') == $role->name)>{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="mt-2">
                            <button type="submit" class="btn btn-primary me-2">Save</button>
                            <a class="btn btn-label-secondary" href="{{ route('users.index') }}">Cancel</a>
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
    @vite(['resources/js/assets/account.js'])
</x-app-layout>
