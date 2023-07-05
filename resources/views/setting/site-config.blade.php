<x-app-layout>
    @vite(['resources/css/assets/profile.css'])
    <x-slot name="header">
        {{ __('Site Configs') }}
    </x-slot>
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">

            <!-- Header -->
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h4 class="card-title">General Settings</h4>
                        </div>
                        <div class="card-body">
                            <form id="GeneralSettings" method="POST"
                                  action="{{ route('siteConfig.siteSettings') }}">
                                @csrf
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="site_name" class="form-label">Site name</label>
                                        <input class="form-control" type="text" id="site_name" name="name"
                                               value="{{ $data['name'] ?? '' }}" autofocus/>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="short_name" class="form-label">Site short name</label>
                                        <input class="form-control" type="text" id="short_name"
                                               name="short_name"
                                               value="{{ $data['short_name'] ?? '' }}"/>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="concurrent_session" class="form-label">Concurrent
                                            session</label>
                                        <div>
                                            <label class="switch switch-success switch-lg">
                                                <input type="hidden" name="concurrent_session" value="0">
                                                <input type="checkbox" class="switch-input"
                                                       name="concurrent_session"
                                                       @checked($data['concurrent_session'] ?? false) value="1">
                                                <span class="switch-toggle-slider">
                                                <span class="switch-on">On</span>
                                                <span class="switch-off">Off</span>
                                            </span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        @if (config('mail.mailers.smtp.port') && config('mail.mailers.smtp.host')
                                                     && config('mail.mailers.smtp.username') && config('mail.mailers.smtp.password')
                                                       && config('mail.from.address') && config('mail.from.name'))
                                            <p class="text-success mb-0">Mail system is enabled.</p>
                                        @else
                                            <p class="text-warning mb-0">Mail system is not enabled <b>(Configure "Mail
                                                    Setting" to enable mail system).</b></p>
                                        @endif
                                        <label for="concurrent_session" class="form-label">
                                            Mail verification
                                        </label>
                                        <div>
                                            <label class="switch switch-success switch-lg">
                                                <input type="hidden" name="mail_verification" value="0">
                                                <input type="checkbox" class="switch-input"
                                                       name="mail_verification"
                                                       @checked($data['mail_verification'] ?? false) value="1"
                                                       @if (!(config('mail.mailers.smtp.port') && config('mail.mailers.smtp.host')
                                                           && config('mail.mailers.smtp.username') && config('mail.mailers.smtp.password')
                                                           && config('mail.from.address') && config('mail.from.name')))
                                                           disabled
                                                    @endif
                                                >
                                                <span class="switch-toggle-slider">
                                                <span class="switch-on">On</span>
                                                <span class="switch-off">Off</span></span>
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
            </div>
        </div>
    </div>
</x-app-layout>
