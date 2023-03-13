<x-app-layout>
    @vite(['resources/css/assets/profile.css'])
    <x-slot name="header">
        {{ __('Mail Configs') }}
    </x-slot>
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">

            <!-- Header -->
            <div class="row">
                <div class="col-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h4 class="card-title">Mail Settings</h4>
                            </div>
                            <div class="card-body">
                                <form id="SiteSettings" method="POST" action="{{ route('siteConfig.mailSettings') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label for="mail_username" class="form-label">Username</label>
                                            <input class="form-control" type="text" id="mail_username"
                                                   name="mail_username"
                                                   value="{{ $data['mail_username'] ?? '' }}"/>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="mail_password" class="form-label">Password</label>
                                            <input class="form-control" type="password" id="mail_password"
                                                   name="mail_password" value="{{ isset($data['mail_password']) ? '...' : '' }}"/>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="mail_port" class="form-label">Port</label>
                                            <input class="form-control" type="text" id="mail_port" name="mail_port"
                                                   value="{{ $data['mail_port'] ?? '' }}"/>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="mail_host" class="form-label">Host</label>
                                            <input class="form-control" type="text" id="mail_host" name="mail_host"
                                                   value="{{ $data['mail_host'] ?? '' }}"/>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="mail_from_address" class="form-label">From address</label>
                                            <input class="form-control" type="text" id="mail_from_address"
                                                   name="mail_from_address"
                                                   value="{{ $data['mail_from_address'] ?? '' }}"/>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="mail_from_name" class="form-label">From name</label>
                                            <input class="form-control" type="text" id="mail_from_name"
                                                   name="mail_from_name" value="{{ $data['mail_from_name'] ?? '' }}"/>
                                        </div>
                                    </div>
                                    <div class="mt-2">
                                        <button type="submit" class="btn btn-primary me-2">Save changes</button>
                                        <button type="reset" class="btn btn-label-secondary">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
