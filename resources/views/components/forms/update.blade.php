<!-- Happiness is not something readymade. It comes from your own actions. - Dalai Lama -->
<!-- Simplicity is an acquired taste. - Katharine Gerould -->
<form method="POST" action="{{ route($type . '.update', [$type => $item]) }}" enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <!-- inputs -->
    <div @class(['form-group md:grid grid-cols-2 gap-2'])>
        @foreach ($fields as $attr => $value)
            <div class="m-2">
                @php
                    $component = 'inputs.' . $value['field'];
                    $fill = $item->{$attr};
                @endphp

                <x-input-label for="{{ $attr }}" value="{!! $value['title'] !!}"></x-input-label>

                <x-dynamic-component :component="$component" id="{{ $attr }}"
                    class="block mt-1 w-full border-2 p-2 rounded outline-0" type="{{ $value['field'] }}"
                    name="{{ $attr }}" value="{{ old($attr) ?? $fill }}" autocomplete="{{ $attr }}" />

                @error($attr)
                    <x-input-error messages="{{ $message }}" class="mt-2" />
                @enderror
            </div>
        @endforeach
    </div>

    <div class="flex items-center justify-start mt-4">
        <x-primary-button class="ml-4">
            {{ __('Modifier') }}
        </x-primary-button>
    </div>
</form>

