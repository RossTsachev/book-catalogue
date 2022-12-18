<x-app-layout>
    <x-slot name="header">
        <x-index.header>Book Details</x-header>
    </x-slot>

    <x-index.main-content>
        <ul class="flex flex-col">
            <x-show.list-item title="Name">
                {{ $book->name }}
            </x-show.list-item>
            <x-show.list-item title="Authors">
                <ul>
                    @foreach ($book->authors as $author)
                        <li>
                            <a href="{{ route('authors.show', ['author' => $author]) }}">
                                {{ $author->first_name }} {{ $author->last_name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </x-show.list-item>
            <x-show.list-item title="Description">
                {{ $book->description }}
            </x-show.list-item>
            <x-show.list-item title="Cover">
                <img src="{{ asset('storage/' . $book->cover) }}" alt="Book" class="mx-auto max-w-sm h-auto">
            </x-show.list-item>
            <x-show.list-item title="Published At">
                {{ $book->published_at }}
            </x-show.list-item>
            <x-show.list-item title="Is Signed By Author">
                {{ $book->is_signed_by_author ? 'Yes' : 'No' }}
            </x-show.list-item>
            <x-show.list-item title="Is Fiction">
                {{ $book->is_fiction ? 'Yes' : 'No' }}
            </x-show.list-item>
        </ul>

        <div class="flex items-center justify-end mt-4">
            <x-show.delete-button class="ml-4" :formAction="route('books.destroy', ['book' => $book])">
                Delete
            </x-show.delete-button>
            <x-show.edit-button class="ml-4" :hrefLink="route('books.edit', ['book' => $book])">
                Edit
            </x-show.edit-button>
        </div>
    </x-main-content>
</x-app-layout>
