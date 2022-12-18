<x-app-layout>
    <x-slot name="header">
        <x-index.header>Dashboard</x-header>
    </x-slot>

    <div class="py-12">
        <div class="w-full max-w-7xl sm:px-6 lg:px-8 mx-auto bg-white shadow-lg
                rounded-sm border border-gray-200">
            <div class="p-3">
                <div class="overflow-x-auto">
                    <table aria-label="Dashboard" class="table-auto w-full">
                        <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
                            <tr>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Author</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Books</div>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="text-sm divide-y divide-gray-100">
                            @foreach($authors as $author)
                                <tr>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="font-medium text-gray-800">
                                                <a href="{{ route('authors.show', ['author' => $author]) }}">
                                                    {{ $author->first_name }} {{ $author->last_name }}
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap">
                                        @foreach($author->books as $book)
                                            <div class="text-left">
                                                <a href="{{ route('books.show', ['book' => $book]) }}">
                                                    {{ $book->name }}
                                                </a>
                                            </div>
                                        @endforeach
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $authors->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
