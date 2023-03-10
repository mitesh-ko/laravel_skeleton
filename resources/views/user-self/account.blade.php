<x-app-layout>
    <link rel="stylesheet" href="/assets/vendor/libs/sweetalert2/sweetalert2.css"/>
    <x-slot name="header">
        {{ __('My Account') }}
    </x-slot>
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">

            <div class="card mb-4">
                <!-- Account -->
                <div class="card-body">
                    <div class="d-flex align-items-start align-items-sm-center gap-4">
                        <img
                            src="/assets/img/profile_placeholder.jpg"
                            alt="user-avatar"
                            class="d-block w-px-100 h-px-100 rounded"
                            id="uploadedAvatar"
                        />
                        <div class="button-wrapper">
                            <label for="upload" class="btn btn-primary me-2 mb-3" tabindex="0">
                                <span class="d-none d-sm-block">Upload new photo</span>
                                <i class="ti ti-upload d-block d-sm-none"></i>
                                <input type="file" id="upload" class="account-file-input" hidden
                                       accept="image/png, image/jpeg"/>
                            </label>
                            <button type="button" class="btn btn-label-secondary account-image-reset mb-3">
                                <i class="ti ti-refresh-dot d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Reset</span>
                            </button>

                            <div class="text-muted">Allowed JPG, GIF or PNG. Max size of 800K</div>
                        </div>
                    </div>
                </div>
                <hr class="my-0"/>
                <div class="card-body">
                    <form id="formAccountSettings" method="POST" action="{{ route('account.update') }}">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="firstName" class="form-label">Name</label>
                                <input class="form-control" type="text" id="name" name="name"
                                       value="{{ auth()->user()->name }}" autofocus/>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="email" class="form-label">E-mail</label>
                                <input class="form-control" type="text" id="email" name="email"
                                       value="{{ auth()->user()->email }}" placeholder="user@example.com"/>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="phoneNumber">Phone Number</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text">IN (+91)</span>
                                    <input type="text" id="phoneNumber" name="phone" class="form-control"
                                           placeholder="{{ auth()->user()->phone }}"/>
                                </div>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="address" class="form-label">
                                    <del>Address</del>
                                </label>
                                <input type="text" class="form-control" id="address" name="address"
                                       placeholder="Address"/>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="state" class="form-label">
                                    <del>State</del>
                                </label>
                                <input class="form-control" type="text" id="state" name="state"
                                       placeholder="California"/>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="zipCode" class="form-label">
                                    <del>Zip Code</del>
                                </label>
                                <input type="text" class="form-control" id="zipCode" name="zipCode" placeholder="231465"
                                       maxlength="6"/>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="country">
                                    <del>Country</del>
                                </label>
                                <select id="country" class="select2 form-select">
                                    <option value="">Select</option>
                                    <option value="India">India</option>
                                    <option value="United States">United States</option>
                                    <option value="Australia">Australia</option>
                                    <option value="Bangladesh">Bangladesh</option>
                                    <option value="Belarus">Belarus</option>
                                    <option value="Brazil">Brazil</option>
                                    <option value="Canada">Canada</option>
                                </select>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="language" class="form-label">
                                    <del>Language</del>
                                </label>
                                <select id="language" class="select2 form-select">
                                    <option value="">Select Language</option>
                                    <option value="en">English</option>
                                    <option value="fr">French</option>
                                    <option value="de">German</option>
                                    <option value="pt">Portuguese</option>
                                </select>
                            </div>
                        </div>
                        <div class="mt-2">
                            <button type="submit" class="btn btn-primary me-2">Save changes</button>
                            <button type="reset" class="btn btn-label-secondary">Cancel</button>
                        </div>
                    </form>
                </div>
                <!-- /Account -->
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="card mb-4">
                        <h5 class="card-header">Change Password</h5>
                        <div class="card-body">
                            <form id="formChangePassword" action="{{ route('changePassword') }}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="password" class="form-label">Current Password</label>
                                    <input class="form-control @error('old_password') is-invalid @enderror" type="password"
                                           name="old_password"/>
                                    @error('old_password')
                                    <div class="fv-plugins-message-container invalid-feedback">
                                        <div data-field="password" data-validator="notEmpty">
                                            {{ $message }}
                                        </div>
                                    </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">New Password</label>
                                    <input class="form-control @error('password') is-invalid @enderror" type="password"
                                           name="password"/>
                                    @error('password')
                                    <div class="fv-plugins-message-container invalid-feedback">
                                        <div data-field="password" data-validator="notEmpty">
                                            {{ $message }}
                                        </div>
                                    </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Confirm Password</label>
                                    <input class="form-control @error('password_confirmation') is-invalid @enderror" type="password"
                                           name="password_confirmation"/>
                                    @error('password_confirmation')
                                    <div class="fv-plugins-message-container invalid-feedback">
                                        <div data-field="password" data-validator="notEmpty">
                                            {{ $message }}
                                        </div>
                                    </div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card mb-4">
                        <h5 class="card-header">Deactivate Account</h5>
                        <div class="card-body">
                            <div class="mb-3 col-12 mb-0">
                                <div class="alert alert-warning">
                                    <h5 class="alert-heading mb-1">Are you sure you want to deactivate your account?</h5>
                                </div>
                            </div>
                            <form id="formAccountDeactivation" action="{{ route('deactivate') }}" method="post">
                                @csrf
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input class="form-control @error('password') is-invalid @enderror" type="password"
                                           id="password"
                                           name="password"/>
                                    @error('password')
                                    <div class="fv-plugins-message-container invalid-feedback">
                                        <div data-field="password" data-validator="notEmpty">
                                            {{ $message }}
                                        </div>
                                    </div>
                                    @endif
                                </div>
                                <div class="form-check mb-4 col-md-6">
                                    <input class="form-check-input" type="checkbox" name="accountActivation"
                                           id="accountActivation"/>
                                    <label class="form-check-label" for="accountActivation">
                                        I confirm my account deactivation</label>
                                </div>
                                <button type="submit" class="btn btn-danger deactivate-account">Deactivate Account</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content-backdrop fade"></div>
        </div>
    </div>
    <script src="/assets/vendor/libs/form-validation/dist/js/FormValidation.min.js"></script>
    <script src="/assets/vendor/libs/form-validation/dist/js/plugins/Bootstrap5.min.js"></script>
    <script src="/assets/vendor/libs/form-validation/dist/js/plugins/AutoFocus.min.js"></script>
    <script src="/assets/vendor/libs/sweetalert2/sweetalert2.js"></script>
    @vite(['resources/js/assets/account.js'])
</x-app-layout>
