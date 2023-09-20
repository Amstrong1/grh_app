<input {!! $attributes->merge([
    'class' => implode(' ', [$errors->has($name) ? 'form-input is-invalid block w-full' : 'form-input block w-full']),
]) !!}>


{{-- <div class="relative mb-4 flex flex-wrap items-stretch">
    <input {!! $attributes->merge([
        'class' => implode(' ', [
            $errors->has($name) ? 'form-input is-invalid block w-full relative' : 'form-input block w-full relative',
        ]),
    ]) !!}>

    <span
        class="flex items-center whitespace-nowrap rounded-l border border-r-0 border-solid border-neutral-300 px-3 py-[0.25rem] text-center text-base font-normal leading-[1.6] text-neutral-700 dark:border-neutral-600 dark:text-neutral-200 dark:placeholder:text-neutral-200"
        id="basic-addon1">@</span>
</div> --}}
