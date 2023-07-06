<textarea
    {{ $attributes->merge([
        'class' => implode(' ', [
        $errors->has($name) ? 'form-input is-invalid block w-full capitalize placeholder:italic' : 'form-input block w-full capitalize placeholder:italic'
        ]),
    ]) }} rows=5>{{ $slot }}</textarea>
