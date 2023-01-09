@props(['name', 'label', 'value', 'type' => 'text'])

<x-form.field>
    <x-input-label for="{{ $name }}" value="{{ $label }}" class="mb-2" />

    <div class="relative">
        <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
            <svg
                aria-hidden="true"
                class="w-5 h-5 text-gray-500 dark:text-gray-400"
                fill="currentColor"
                viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path
                    fill-rule="evenodd"
                    d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0
                    10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                    clip-rule="evenodd">
                </path>
            </svg>
        </div>
        <input
            type="text"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500
                focus:border-blue-500 block w-full pl-10 dark:bg-gray-700 dark:border-gray-600
                dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            placeholder="Select date"
            id="{{ $name }}"
            name="{{ $name }}"
            {{ $attributes(['value' => old($name, $value)]) }}
        >
    </div>

    <x-input-error :messages="$errors->get($name)" class="mt-2" />
</x-form.field>

<script type="module">
    const datepickerEl = document.getElementById('{{ $name }}');
    new Datepicker(datepickerEl, {
        'format': 'yyyy-mm-dd'
    });
</script>
