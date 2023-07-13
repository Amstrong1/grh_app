<!-- Simplicity is an acquired taste. - Katharine Gerould -->
<form method="POST" action="{{ route($type . '.store') }}" enctype="multipart/form-data">
    @csrf

    <!-- inputs -->
    <div @class(['form-group md:grid grid-cols-2 gap-2 mt-4'])>
        @foreach ($fields as $attr => $value)
            <div class="m-2">
                @php
                    $component = 'inputs.' . $value['field'];
                @endphp

                @if ($value['field'] === 'model')
                    <x-input-label for="{{ $attr }}" value="{!! $value['title'] !!}"></x-input-label>

                    <x-dynamic-component :component="$component" id="{{ $attr }}" name="{{ $attr }}"
                        class="block mt-1 w-full border-2 p-2 rounded outline-0">
                        <option value="">Cliquer pour sélectionner</option>
                        @foreach ($value['options'] as $item)
                            <option value="{{ $item->id }}" @selected(old($attr) ? old($attr) === $item->id : '' === $item->id)>
                                {{ $item->name }}
                            </option>
                        @endforeach
                    </x-dynamic-component>
                    @error($attr)
                        <x-input-error messages="{{ $message }}" class="mt-2" />
                    @enderror
                @elseif ($value['field'] === 'select')
                    <x-input-label for="{{ $attr }}" value="{!! $value['title'] !!}"></x-input-label>

                    <x-dynamic-component :component="$component" id="{{ $attr }}" name="{{ $attr }}"
                        class="block mt-1 w-full border-2 p-2 rounded outline-0">
                        <option value="">Cliquer pour sélectionner</option>
                        @foreach ($value['options'] as $key => $option)
                            <option value="{{ $key }}" @selected(old($attr) ?? old($attr) === $key)>{{ $option }}
                            </option>
                        @endforeach
                    </x-dynamic-component>
                    @error($attr)
                        <p class="text-red-500 text-sm pl-2 pt-2">
                            {{ $message }}
                        </p>
                    @enderror
                @elseif ($value['field'] === 'multiple-select')
                    <x-input-label for="{{ $attr }}" value="{!! $value['title'] !!}"></x-input-label>

                    <x-dynamic-component :component="$component" id="{{ $attr }}" name="{{ $attr }}[]"
                        class="block mt-1 w-full border-2 p-2 rounded outline-0 capitalize">
                        @foreach ($value['options'] as $item)
                            <option value="{{ $item->id }}" @selected(old($attr))>
                                {{ $item->name }}</option>
                        @endforeach
                    </x-dynamic-component>
                    @error($attr)
                        <p class="text-red-500 text-sm pl-2 pt-2">
                            {{ $message }}
                        </p>
                    @enderror
                @elseif ($value['field'] === 'textarea' || $value['field'] === 'richtext')
                    <x-input-label for="{{ $attr }}" value="{!! $value['title'] !!}"></x-input-label>

                    <x-dynamic-component :component="$component" id="{{ $attr }}" name="{{ $attr }}"
                        type="{{ $value['field'] }}" class="block mt-1 w-full border-2 p-2 rounded outline-0 capitalize">
                        {{ old($attr) }}</x-dynamic-component>
                    @error($attr)
                        <p class="text-red-500 text-sm pl-2 pt-2">
                            {{ $message }}
                        </p>
                    @enderror
                @else
                    <x-input-label for="{{ $attr }}" value="{!! $value['title'] !!}"></x-input-label>

                    <x-dynamic-component :component="$component" id="{{ $attr }}"
                        class="block mt-1 w-full border-2 p-2 rounded outline-0" type="{{ $value['field'] }}"
                        name="{{ $attr }}" value="{{ old($attr) }}" autocomplete="{{ $attr }}" />

                    @error($attr)
                        <x-input-error messages="{{ $message }}" class="mt-2" />
                    @enderror
                @endif
            </div>
        @endforeach
    </div>

    <div class="flex items-center justify-start mt-4">
        <x-primary-button class="ml-4">
            {{ __('Ajouter') }}
        </x-primary-button>
    </div>
</form>
