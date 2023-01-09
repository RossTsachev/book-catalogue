@props(['name', 'id', 'label', 'items', 'selectedItems' => [], 'type' => 'text'])

<x-form.field>

    <x-input-label
        for="{{ $name }}[]"
        value="{{ $label }}"
        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" />

    <select
        name="{{ $name }}[]"
        id="{{ $id }}"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500
            focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600
            dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        multiple
    >
        @foreach ($items as $item)
            <option
                value="{{ $item->id }}"
                @if((old($name) == $item->id) || (in_array($item->id, $selectedItems))) selected @endif
            >{{ $item->data_for_select }}</option>
        @endforeach
    </select>

    <x-input-error :messages="$errors->get($name)" class="mt-2" />
</x-form.field>

<script type="module">
    new TomSelect('#authors');
</script>
