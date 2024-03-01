@props(['disabled' => false, 'required' => false])

<input type="file" {{ $disabled ? 'disabled' : '' }} {{ $required ? 'required' : '' }}
    {!! $attributes->merge(['class' => '
            dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm
            border-0 outline outline-1 outline-gray-300 dark:outline-gray-700
            cursor-pointer file:cursor-pointer file:border-0 file:py-2 file:px-4 file:bg-gray-100 file:hover:bg-gray-200
    ']) !!}>
