<x-app-layout>
    <x-slot name="header">
        <x-index.header>Author Details</x-header>
    </x-slot>

    <x-index.main-content>
        <ul class="flex flex-col">
            <x-show.list-item title="First Name">
                {{ $author->first_name }}
            </x-show.list-item>
            <x-show.list-item title="Last Name">
                {{ $author->last_name }}
            </x-show.list-item>
            <x-show.list-item title="Books">
                <ul>
                    @foreach ($author->books as $book)
                        <li><a href="{{ route('books.show', ['book' => $book]) }}">{{ $book->name }}</a></li>
                    @endforeach
                </ul>
            </x-show.list-item>
        </ul>

        <div class="flex items-center justify-end mt-4">
            <x-show.delete-button class="ml-4" :formAction="route('authors.destroy', ['author' => $author])">
                Delete
            </x-show.delete-button>
            <x-show.edit-button class="ml-4" :hrefLink="route('authors.edit', ['author' => $author])">
                Edit
            </x-show.edit-button>
        </div>
    </x-main-content>
</x-app-layout>
