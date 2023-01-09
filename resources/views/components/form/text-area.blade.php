@props(['name', 'label', 'value', 'type' => 'text'])

<x-form.field>
    <x-input-label
        for="{{ $name }}"
        value="{{ $label }}"
        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" />

    <textarea
        id="{{ $name }}"
        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300
            focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600
            dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        type="{{ $type }}"
        name="{{ $name }}"
        rows=3
    >
        {{ $slot->isNotEmpty() ? $slot : old($name, $value) }}
    </textarea>

    <x-input-error :messages="$errors->get($name)" class="mt-2" />
</x-form.field>
