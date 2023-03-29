<x-guest-layout>

    @vite(['resources/css/assets/login.css'])
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner py-4">
                <!-- Reset Password -->
                <div class="card">
                    <div class="card-body">
                        <div class="app-brand justify-content-center mb-4 mt-2">
                            <a href="/" class="app-brand-link gap-2">
                                <span class="app-brand-text demo text-body fw-bold ms-1">{{ config('app.name') }}</span>
                            </a>
                        </div>
                        <h6>Hello {{ auth()->user()?->full_name }} enter your authenticator code.</h6>
                        @if(session('message'))
                            <div class="alert alert-warning">
                                <h6 class="alert-heading mb-1">{{ session('message') }}</h6>
                            </div>
                        @endif
                        <form method="POST" action="{{ route('verify.2fa') }}">
                            @csrf
                            <div class="mb-3 form-input">
                                <label for="code" class="form-label">Code</label>
                                <div class="d-flex">
                                    <input type="text" name="code[]"
                                           class="twofa-code form-control m-2 @error('code') is-invalid @enderror" autofocus>
                                    <input type="text" name="code[]"
                                           class="twofa-code form-control m-2 @error('code') is-invalid @enderror">
                                    <input type="text" name="code[]"
                                           class="twofa-code form-control m-2 @error('code') is-invalid @enderror">
                                    <input type="text" name="code[]"
                                           class="twofa-code form-control m-2 @error('code') is-invalid @enderror">
                                    <input type="text" name="code[]"
                                           class="twofa-code form-control m-2 @error('code') is-invalid @enderror">
                                    <input type="text" name="code[]"
                                           class="twofa-code form-control m-2 @error('code') is-invalid @enderror">
                                </div>
                                <x-input-error :messages="$errors->get('code')" class="mt-1"/>
                            </div>
                            <button class="btn btn-primary d-grid w-100 mb-3 mt-3">{{ __('Submit') }}</button>
                        </form>
                    </div>
                </div>
                <!-- /Reset Password -->
            </div>
        </div>
    </div>
    @vite(['resources/js/assets/login.js'])
</x-guest-layout>
