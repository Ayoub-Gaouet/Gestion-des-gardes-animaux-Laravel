@props(['errors'])

@if ($errors->any())
    <div {{ $attributes }}>
        <div class="font-medium text-red-600 text-danger">
            {{ __('messages.Whoops') }}
        </div>

        <ul class="mt-3 list-disc list-inside text-sm text-red-600 text-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
