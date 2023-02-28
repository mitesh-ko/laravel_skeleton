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
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="email" class="form-label">Body</label>
                                <textarea class="form-control" id="body" name="body" rows="20">
                                    {{ old('body', $emailTemplate->body ?? '') }}
                                </textarea>
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
