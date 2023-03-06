<x-guest-layout>

    @vite(['resources/css/assets/login.css'])
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner py-4">
                <!-- Reset Password -->
                <div class="card">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center mb-4 mt-2">
                            <a href="/" class="app-brand-link gap-2">
                                <span class="app-brand-text demo text-body fw-bold ms-1">{{ config('site.name') }}</span>
                            </a>
                        </div>
                        <!-- /Logo -->
                        <p class="mb-1 pt-2">Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another. </p>
                        @if (session('status') == 'verification-link-sent')
                            <h4>
                                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                            </h4>
                        @endif
                        <form method="POST" action="{{ route('verification.send') }}">
                            @csrf
                            <button class="btn btn-primary d-grid w-100 mb-3">{{ __('Resend Verification Email') }}</button>
                        </form>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-secondary">
                                {{ __('Log Out') }}
                            </button>
                        </form>
                    </div>
                </div>
                <!-- /Reset Password -->
            </div>
        </div>
    </div>
    @vite(['resources/js/assets/login.js'])
</x-guest-layout>
