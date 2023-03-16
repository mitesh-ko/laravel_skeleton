@props(['messages'])

@if ($messages)
    <div {{ $attributes->merge(['class' => 'invalid-feedback']) }}>
        <div data-field="password" data-validator="notEmpty">
            <ul class="list-unstyled">
                @foreach ((array) $messages as $message)
                    <li class="de">{{ $message }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif
