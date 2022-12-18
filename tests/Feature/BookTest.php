<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\User;
use Tests\TestCase;

/**
 * @internal
 *
 * @coversNothing
 */
class BookTest extends TestCase
{
    public function test_index_page_redirects_to_dashboard()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/books');

        $response->assertRedirectToRoute('dashboard');
    }

    public function test_show_page_exists()
    {
        $user = User::factory()->create();

        $book = Book::factory()->create();

        $response = $this->actingAs($user)->get("/books/{$book->id}");

        $response->assertStatus(200);

        $response->assertSeeTextInOrder([$book->name, $book->description]);
    }
}
