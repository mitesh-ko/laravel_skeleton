<x-app-layout>
    @vite(['resources/css/assets/profile.css'])
    <x-slot name="header">
        {{ __('Site Configs') }}
    </x-slot>
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">

            <!-- Header -->
            <div class="row">
                <div class="col-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h4 class="card-title">General Settings</h4>
                        </div>
                        <div class="card-body">
                            <form id="GeneralSettings" method="POST" action="{{ route('siteConfig.siteSettings') }}">
                                @csrf
                                <div class="row">
                                    <div class="mb-3 col-md-12">
                                        <label for="site_name" class="form-label">Site name</label>
                                        <input class="form-control" type="text" id="site_name" name="name"
                                               value="{{ $data['name'] ?? '' }}" autofocus/>
                                    </div>
                                    <div class="mb-3 col-md-12">
                                        <label for="short_name" class="form-label">Site short name</label>
                                        <input class="form-control" type="text" id="short_name"
                                               name="short_name"
                                               value="{{ $data['short_name'] ?? '' }}"/>
                                    </div>
                                    <div class="mb-3 col-md-12">
                                        <label for="timezone" class="form-label">Timezone</label>
                                        <select class="form-control" id="timezone" name="timezone">
                                            @foreach(config('timezones') as $value)
                                                <option
                                                    value="{{ $value['name'] }}" @selected($data['timezone'] ?? '' == $value['name'])>
                                                    {{ $value['name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3 col-md-12">
                                        <label for="concurrent_session" class="form-label">Concurrent session</label>
                                        <div>
                                            <label class="switch switch-success switch-lg">
                                                <input type="hidden" name="concurrent_session" value="0">
                                                <input type="checkbox" class="switch-input" name="concurrent_session"
                                                       @checked($data['concurrent_session'] ?? false) value="1">
                                                <span class="switch-toggle-slider">
                                                <span class="switch-on">On</span>
                                                <span class="switch-off">Off</span>
                                            </span>
                                            </label>
                                        </div>
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

                <div class="col-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h4 class="card-title">Mail Settings</h4>
                        </div>
                        <div class="card-body">
                            <form id="SiteSettings" method="POST" action="{{ route('siteConfig.mailSettings') }}">
                                @csrf
                                <div class="row">
                                    <div class="mb-3 col-md-12">
                                        <label for="mail_username" class="form-label">Username</label>
                                        <input class="form-control" type="text" id="mail_username" name="mail_username"
                                               value="{{ $data['mail_username'] ?? '' }}"/>
                                    </div>
                                    <div class="mb-3 col-md-12">
                                        <label for="mail_password" class="form-label">Password</label>
                                        <input class="form-control" type="password" id="mail_password"
                                               name="mail_password"/>
                                    </div>
                                    <div class="mb-3 col-md-12">
                                        <label for="mail_port" class="form-label">Port</label>
                                        <input class="form-control" type="text" id="mail_port" name="mail_port"
                                               value="{{ $data['mail_port'] ?? '' }}"/>
                                    </div>
                                    <div class="mb-3 col-md-12">
                                        <label for="mail_host" class="form-label">Host</label>
                                        <input class="form-control" type="text" id="mail_host" name="mail_host"
                                               value="{{ $data['mail_host'] ?? '' }}"/>
                                    </div>
                                    <div class="mb-3 col-md-12">
                                        <label for="mail_from_address" class="form-label">From address</label>
                                        <input class="form-control" type="text" id="mail_from_address"
                                               name="mail_from_address" value="{{ $data['mail_from_address'] ?? '' }}"/>
                                    </div>
                                    <div class="mb-3 col-md-12">
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
