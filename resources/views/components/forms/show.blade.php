<!-- Simplicity is an acquired taste. - Katharine Gerould -->

<!-- inputs -->
<div @class(['form-group md:grid grid-cols-2 gap-2 mt-4'])>
    @foreach ($fields as $attr => $value)
        @php
            $fill = $item->{$attr};
        @endphp

        <div class="m-2">

            <x-input-label for="{{ $attr }}" value="{!! $value['title'] !!}"></x-input-label>

            <x-text-input class="block mt-1 w-full border-2 p-2 rounded outline-0" value="{{ old($attr->value()) ?? $fill->value() }}"
                readonly />

        </div>
    @endforeach
</div>
