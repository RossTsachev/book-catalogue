<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use App\Http\Requests\StoreAuthorRequest;
use App\Http\Requests\UpdateAuthorRequest;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authors = Author::with('books')->orderBy('id', 'desc')->paginate();

        return view('dashboard')->with('authors', $authors);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('authors.form')
            ->with('author', new Author())
            ->with('formMethod', 'POST')
            ->with('formAction', route('authors.store'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAuthorRequest $request)
    {
        $author = new Author($request->validated());

        $author->save();

        return redirect()->route('authors.show', ['author' => $author]);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Author $author)
    {
        return view('authors.show')->with('author', $author);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Author $author)
    {
        return view('authors.form')
        ->with('author', $author)
        ->with('formMethod', 'PUT')
        ->with('formAction', route('authors.update', ['author' => $author]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAuthorRequest $request, Author $author)
    {
        $author->update($request->validated());

        return redirect()->route('authors.show', ['author' => $author]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Author $author)
    {
        $bookIds = $author->books->pluck('id');
        $author->delete();

        // remove all books without author
        $books = Book::with('authors')->whereIn('id', $bookIds)->get();
        foreach ($books as $book) {
            if (!$book->authors->count()) {
                $book->delete();
            }
        }

        return redirect()->route('dashboard');
    }
}
