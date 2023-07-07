<x-app-layout>
    <x-slot name="header">
        {{  isset($transaction) ? __('Update Transaction') : __('New Transaction') }}
    </x-slot>
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">

            <div class="card mb-4">
                <!-- Account -->
                <div class="card-body">
                    <form id="formAccountSettings" method="POST" enctype="multipart/form-data"
                          action="{{ isset($transaction) ? route('transactions.update', $transaction->id) :  route('transactions.store') }}">
                        @csrf
                        @isset($transaction)
                            @method('PUT')
                        @endif
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="type" class="form-label">Type</label>
                                <select class="form-control @error('type') is-invalid @enderror" id="type" name="type" autofocus>
                                    <option value="income" @selected(old('type', $transaction->type ?? 'Income') == 'income')>Income</option>
                                    <option value="expense" @selected(old('type', $transaction->type ?? 'Expense') == 'expense')>Expense</option>
                                </select>
                                <x-input-error :messages="$errors->get('type')" class="mt-1" />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="amount" class="form-label">Amount</label>
                                <input class="form-control @error('amount') is-invalid @enderror" type="text" id="amount" name="amount"
                                       value="{{ old('amount', $transaction->amount ?? '') }}"/>
                                <x-input-error :messages="$errors->get('amount')" class="mt-1" />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="payment_date" class="form-label">Payment Date</label>
                                <input class="form-control @error('payment_date') is-invalid @enderror" type="date" id="payment_date" name="payment_date"
                                       value="{{ old('payment_date', \Carbon\Carbon::parse($transaction->payment_date, config('app.timezone'))
                                       ->setTimezone(Cookie::get('timezone'))->format('Y-m-d') ?? '') }}"/>
                                <x-input-error :messages="$errors->get('payment_date')" class="mt-1" />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="desc" class="form-label">Description</label>
                                <input class="form-control @error('desc') is-invalid @enderror" type="text" id="desc" name="desc"
                                       value="{{ old('desc', $transaction->desc ?? '') }}"/>
                                <x-input-error :messages="$errors->get('desc')" class="mt-1" />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-control @error('status') is-invalid @enderror" id="status" name="status">
                                    <option value="paid" @selected(old('status', 'Paid') == 'paid')>Paid</option>
                                    <option value="unpaid" @selected(old('status', 'Unpaid') == 'unpaid')>Unpaid</option>
                                </select>
                                <x-input-error :messages="$errors->get('status')" class="mt-1" />
                            </div>
                        </div>
                        <div class="mt-2">
                            <button type="submit" class="btn btn-primary me-2">Save</button>
                            <a class="btn btn-label-secondary" href="{{ route('transactions.index') }}">Cancel</a>
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
</x-app-layout>
