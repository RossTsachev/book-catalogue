@props(['name', 'label', 'items'])

<x-form.field>
    <x-input-label for="{{ $name }}" value="{{ $label }}" class="mb-2" />

    <div class="flex">
        @foreach ($items as $key => $item)
            <div class="flex items-center mr-4">
                <input
                    @if($item->checked) checked="checked" @endif
                    id="inline-radio-{{ $key }}}"
                    type="radio"
                    value="{{ $item->value }}"
                    name="{{ $name }}"
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500
                        dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700
                        dark:border-gray-600">
                <label
                    for="inline-radio-{{ $key }}"
                    class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                    {{ $item->label }}
                </label>
            </div>
        @endforeach
    </div>
</x-form.field>
