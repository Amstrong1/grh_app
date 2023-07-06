<input type="time" {!! $attributes->merge([
    'class' => implode(' ', [
        $errors->has($name) ? 'form-input is-invalid block w-full placeholder:italic' : 'form-input block w-full placeholder:italic'
    ]), 
]) !!}>