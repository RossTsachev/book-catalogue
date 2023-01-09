@props(['name', 'label', 'value'])

<x-form.field>
    @if ($value)
        <figure class="max-w-xs">
            <img
                class="max-w-xs h-auto"
                src="/storage/{{ $value }}"
                alt="{{ $label }}">
            <figcaption
                class="mt-2 text-sm text-center text-gray-500 dark:text-gray-400">
                Delete existing {{ Str::lower($label) }}?

                <div class="mt-1">
                    <label class="inline-flex relative items-center cursor-pointer">
                    <input
                        type="checkbox"
                        name="delete-{{ $name }}"
                        value=1
                        class="sr-only peer"
                    >
                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300
                        dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700
                        peer-checked:after:translate-x-full peer-checked:after:border-white after:content-['']
                        after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300
                        after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600
                        peer-checked:bg-blue-600">
                    </div>
                </div>

            </figcaption>
        </figure>
    @endif

    <x-input-label
        for="{{ $name }}"
        value="{{ ($value) ? 'Change ' . $label : $label }}"
        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" />

    <input
        id="{{ $name }}"
        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer
            bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600
            dark:placeholder-gray-400"
        type="file"
        name="{{ $name }}"
        :value = "old($name, $value)"
    />

    <x-input-error :messages="$errors->get($name)" class="mt-2" />
</x-form.field>
