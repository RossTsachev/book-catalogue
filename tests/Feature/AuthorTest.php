<?php

namespace Tests\Feature;

use App\Models\Author;
use App\Models\User;
use Tests\TestCase;

/**
 * @internal
 *
 * @coversNothing
 */
class AuthorTest extends TestCase
{
    public function test_base_page_exists()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/');

        $response->assertStatus(200);
    }

    public function test_base_page_is_only_accessed_if_authenticated()
    {
        $response = $this->get('/');

        $response->assertStatus(302);
        $response->assertRedirect('login');
    }

    public function test_index_page_exists()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/authors');

        $response->assertStatus(200);

        $response->assertSeeTextInOrder(['Dashboard', 'Author', 'Book']);
    }

    public function test_show_page_exists()
    {
        $user = User::factory()->create();

        $author = Author::factory()->create();

        $response = $this->actingAs($user)->get("/authors/{$author->id}");

        $response->assertStatus(200);

        $response->assertSeeTextInOrder([$author->first_name, $author->last_name]);
    }

    public function test_create_author_form_exists()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/authors/create');

        $response->assertStatus(200);
    }

    public function test_store_author()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/authors', [
            'first_name' => 'Bilbo',
            'last_name' => 'Baggins',
        ]);

        $this->assertDatabaseHas('authors', ['first_name' => 'Bilbo', 'last_name' => 'Baggins']);

        $latestAuthor = Author::orderBy('id', 'desc')->first();

        $response->assertRedirectToRoute('authors.show', ['author' => $latestAuthor]);
    }
}
