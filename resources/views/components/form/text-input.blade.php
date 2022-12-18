@props(['name', 'label', 'value'])

<x-form.field>
    <x-input-label
        for="{{ $name }}"
        value="{{ $label }}"
        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" />

    <input
        id="{{ $name }}"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500
            focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600
            dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        type="text"
        name="{{ $name }}"
        value="{{ old($name, $value) }}"
    />

    <x-input-error :messages="$errors->get($name)" class="mt-2" />
</x-form.field>
