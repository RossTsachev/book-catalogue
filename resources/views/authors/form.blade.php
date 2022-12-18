<x-app-layout>
    <x-slot name="header">
        <x-index.header>Create Author</x-header>
    </x-slot>

    <x-index.main-content>
        <form method="POST" action="{{ route('authors.store') }}">
            @csrf

            <!-- First Name -->
            <x-form.text-input
                name="first_name"
                label="First Name"
                :value="$author->first_name"
                required
                autofocus
            />

            <!-- Last Name -->
            <x-form.text-input
                name="last_name"
                label="Last Name"
                :value="$author->first_name"
                required
            />

            <div class="flex items-center justify-end mt-4">
                <x-show.submit-button class="ml-4">
                    Save
                </x-show.submit-button>
            </div>

        </form>
    </x-main-content>
</x-app-layout>
