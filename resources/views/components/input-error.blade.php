@props(['messages'])

@if ($messages)
    <div>
        <ul {{ $attributes->merge(['class' => 'text-danger']) }}>
            @foreach ((array) $messages as $message)
                <li>{{ $message }}</li>
            @endforeach
        </ul>
    </div>
@endif
