<x-guest-layout>
    @vite(['resources/css/assets/login.css'])
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner py-4">
                <div class="card">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center mb-4 mt-2">
                            <a href="/" class="app-brand-link gap-2">
                                <span class="app-brand-text demo text-body fw-bold">{{ config('app.name') }}</span>
                            </a>
                        </div>
                        <!-- /Logo -->
                        <h4 class="mb-1 pt-2">Forgot Password? 🔒</h4>
                        <p class="mb-4">{{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}</p>
                        <x-auth-session-status class="mb-4" :status="session('status')"/>

                        <form id="formAuthentication" method="POST" class="mb-3" action="{{ route('password.email') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control" id="email" name="email"
                                       placeholder="Enter your email" autofocus/>
                                <x-input-error :messages="$errors->get('email')" class="mt-2"/>
                            </div>
                            <button class="btn btn-primary d-grid w-100">{{ __('Email Password Reset Link') }}</button>
                        </form>
                        <div class="text-center">
                            <a href="/" class="d-flex align-items-center justify-content-center">
                                <i class="ti ti-chevron-left scaleX-n1-rtl"></i>
                                Back to login
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="/assets/vendor/libs/form-validation/dist/js/FormValidation.min.js"></script>
    <script src="/assets/vendor/libs/form-validation/dist/js/plugins/Bootstrap5.min.js"></script>
    <script src="/assets/vendor/libs/form-validation/dist/js/plugins/AutoFocus.min.js"></script>
    @vite(['resources/js/assets/login.js'])
</x-guest-layout>
