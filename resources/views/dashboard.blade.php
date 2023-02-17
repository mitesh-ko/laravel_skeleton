<x-app-layout>
    <x-slot name="header">
            {{ __('Dashboard') }}
    </x-slot>

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">Page 1</h4>
        <p>{{ __("You're logged in!") }}</p>
    </div>
</x-app-layout>
