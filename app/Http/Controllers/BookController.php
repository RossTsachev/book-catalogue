<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Author;
use App\Models\Book;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect(route('dashboard'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('books.form')
            ->with('book', new Book())
            ->with('authors', Author::all())
            ->with('formMethod', 'POST')
            ->with('formAction', route('books.store'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBookRequest $request)
    {
        $book = new Book($request->validated());

        $book->cover = $this->getCoverName($request->cover);

        $book->save();

        $book->authors()->sync($request->authors);

        return redirect()->route('books.show', ['book' => $book]);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return view('books.show')->with('book', $book);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        return view('books.form')
            ->with('book', $book)
            ->with('authors', Author::all())
            ->with('formMethod', 'PUT')
            ->with('formAction', route('books.update', ['book' => $book]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
        $book->update($request->validated());

        if ($request->input('delete-cover') || $request->cover) {
            Storage::delete($book->cover);
        }

        $book->cover = $this->getCoverName($request->cover, $book->cover);

        $book->save();

        $book->authors()->sync($request->authors);

        return redirect()->route('books.show', ['book' => $book]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->route('dashboard');
    }

    private function getCoverName($coverInput, $oldInput = null)
    {
        return ($coverInput)
            ? request()->file('cover')->store('book_covers')
            : $oldInput;
    }
}
