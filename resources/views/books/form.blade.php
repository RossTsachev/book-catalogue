<x-app-layout>
    <x-slot name="header">
        <x-index.header>Create Book</x-header>
    </x-slot>

    <x-index.main-content>
        <form method="POST" action="{{ $formAction }}" enctype="multipart/form-data">
            @csrf
            @method($formMethod)

            <!-- Name -->
            <x-form.text-input
                name="name"
                label="Name"
                :value="$book->name"
                required
                autofocus
            />

            <!-- Authors -->
            <x-form.multi-select
                name="authors"
                id="authors"
                label="Authors"
                :items="$authors"
                :selectedItems="$book->authors->pluck('id')->toArray()"
                required
            />

            <!-- Description -->
            <x-form.text-area
                name="description"
                label="Description"
                :value="$book->description"
                required
            />

            <!-- Cover -->
            <x-form.file-input
                name="cover"
                label="Cover"
                :value="$book->cover"
                required
            />

            <!-- Published at -->
            <x-form.datepicker
                name="published_at"
                label="Published at"
                :value="$book->published_at"
                required
            />

            <!-- Is signed by author -->
            <x-form.checkbox
                name="is_signed_by_author"
                label="Is signed by author"
                :value="$book->is_signed_by_author"
            />

            <!-- Is fiction -->
            <x-form.radio-group
                name="is_fiction"
                label="Is fiction"
                :items="$book->getFictionRadioData()"
            />

            <div class="flex items-center justify-end mt-4">
                <x-show.submit-button class="ml-4">
                    Save
                </x-show.submit-button>
            </div>

        </form>
    </x-main-content>
</x-app-layout>
