<x-app-layout>
    <x-slot name="header">
        {{  isset($emailTemplate) ? __('Update email template') : __('Create new email template') }}
    </x-slot>
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">

            <div class="card mb-4">
                <div class="card-body">
                    <form id="formAccountSettings" method="POST"
                          action="{{ isset($emailTemplate) ? route('emailTemplate.update', $emailTemplate->id) :  '' }}">
                        @csrf
                        @isset($emailTemplate)
                            @method('PUT')
                        @endif
                        <div class="row">
                            <div class="mb-3 col-md-4">
                                <label for="firstName" class="form-label">Name</label>
                                <input class="form-control" type="text" id="name" name="name"
                                       value="{{ old('user', $emailTemplate->name ?? '') }}" autofocus/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-4">
                                <label for="email" class="form-label">Subject</label>
                                <input class="form-control" type="text" id="subject" name="subject"
                                       value="{{ old('subject', $emailTemplate->subject ?? '') }}"/>
                            </div>
                        </div>
                        <hr>
                        <h5>Body</h5>
                        <div class="row">
                            <div class="col-md-6 border-right border-light">
                                @foreach($emailTemplate->body as $value)
                                    @php($key = array_keys($value)[0])
                                    <div class="mb-3">
                                        <label for="email" class="form-label">{{ $key }}</label>
                                        <input class="form-control" name="body[][{{ $key }}]"
                                               value="{{ $value[$key] }}">
                                    </div>
                                @endforeach
                            </div>
                            <div class="col-md-6">
                                <h2>Snippets</h2>
                                <div class="mb-3">
                                    <span class="badge bg-secondary bg-glow">
                                        <span class="text-black mt-1 min-vh-100">{FULL_NAME}</span>
                                    </span>
                                </div>
                                <div class="mb-3">
                                    <span class="badge bg-secondary bg-glow">
                                        <span class="text-black mt-1 min-vh-100">
                                            <span class="text-black mt-1 min-vh-100">{SUBJECT}</span>
                                        </span>
                                    </span>
                                </div>
                                <div class="mb-3">
                                    <span class="badge bg-secondary bg-glow">
                                        <span class="text-black mt-1 min-vh-100">
                                            <span class="text-black mt-1 min-vh-100">{DESCRIPTION}</span>
                                        </span>
                                    </span>
                                </div>
                                <div class="mb-3">
                                    <span class="badge bg-secondary bg-glow">
                                        <span class="text-black mt-1 min-vh-100">
                                            <span class="text-black mt-1 min-vh-100">{PASSWORD_EXPIRED}</span>
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="mt-2">
                            <button type="submit" class="btn btn-primary me-2">Save</button>
                            <a class="btn btn-label-secondary" href="{{ route('emailTemplate.index') }}">Cancel</a>
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
    {{--    @vite(['resources/js/assets/account.js'])--}}
</x-app-layout>
