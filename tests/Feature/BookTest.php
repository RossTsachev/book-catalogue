<?php

namespace Tests\Feature;

use App\Models\Author;
use App\Models\Book;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @internal
 *
 * @coversNothing
 */
class BookTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    public function test_index_page_redirects_to_dashboard()
    {
        $response = $this->actingAs($this->user)->get('/books');

        $response->assertRedirectToRoute('dashboard');
    }

    public function test_show_page_exists()
    {
        $book = Book::factory()->create();

        $response = $this->actingAs($this->user)->get("/books/{$book->id}");

        $response->assertStatus(200);

        $response->assertSeeTextInOrder([$book->name, $book->description]);
    }

    public function test_create_book_form_exists()
    {
        $response = $this->actingAs($this->user)->get('/books/create');

        $response->assertStatus(200);
    }

    public function test_store_book_validations_fail_when_fields_empty()
    {
        $book = [
            'name' => '',
            'authors' => [],
            'description' => '',
            'published_at' => '',
            'is_fiction' => '',
        ];

        $response = $this->actingAs($this->user)->post('/books', $book);

        $response->assertInvalid(['name', 'authors', 'description', 'published_at', 'is_fiction']);
    }

    public function test_store_book_validations_fail_when_fields_not_of_type()
    {
        $book = [
            'name' => 'Text',
            'authors' => 'Text',
            'description' => 'Text',
            'published_at' => 'Text',
            'is_fiction' => 'Text',
        ];

        $response = $this->actingAs($this->user)->post('/books', $book);

        $response->assertInvalid(['authors', 'published_at', 'is_fiction']);
    }

    public function test_store_book()
    {
        $author = Author::factory()->create();

        $book = [
            'name' => 'The Hobbit',
            'description' => 'Great book for children',
            'published_at' => '1937-09-21',
            'is_signed_by_author' => 1,
            'is_fiction' => 1,
        ];
        $this->assertDatabaseMissing('books', $book);

        $response = $this->actingAs($this->user)->post(
            '/books',
            $book + ['authors' => [$author->id]]
        );

        $latestBook = Book::orderBy('id', 'desc')->first();
        $response->assertRedirectToRoute('books.show', ['book' => $latestBook]);
        $this->assertDatabaseHas('books', $book);
    }

    public function test_update_book_form_exists()
    {
        $book = Book::factory()->create();

        $response = $this->actingAs($this->user)->get("/books/{$book->id}/edit");

        $response->assertStatus(200);
        $response->assertSee($book->first_name);
        $response->assertSee($book->last_name);
        $response->assertViewHas('book', $book);
    }

    public function test_update_book()
    {
        $author = Author::factory()->create();
        $originalBookData = [
            'name' => 'The Hobbit',
            'description' => 'Great book for children',
            'published_at' => '1937-09-21',
            'is_signed_by_author' => 1,
            'is_fiction' => 1,
        ];
        $editedBookData = [
            'name' => 'Think and Grow Rich',
            'description' => 'A book about thinking and growing rich',
            'published_at' => '1937-10-22',
            'is_signed_by_author' => 0,
            'is_fiction' => 0,
        ];
        $book = Book::create($originalBookData);

        $response = $this->actingAs($this->user)->put(
            "/books/{$book->id}",
            $editedBookData + ['authors' => [$author->id]]
        );

        $response->assertRedirectToRoute('books.show', ['book' => $book]);
        $this->assertDatabaseHas('books', $editedBookData);
        $this->assertDatabaseMissing('books', $originalBookData);
    }
}
