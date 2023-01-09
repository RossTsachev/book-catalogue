<?php

namespace Tests\Feature;

use App\Models\Author;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @internal
 *
 * @coversNothing
 */
class AuthorTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    public function test_base_page_exists()
    {
        $response = $this->actingAs($this->user)->get('/');

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
        $response = $this->actingAs($this->user)->get('/authors');

        $response->assertStatus(200);
        $response->assertSeeTextInOrder(['Dashboard', 'Author', 'Book']);
    }

    public function test_show_page_exists()
    {
        $author = Author::factory()->create();

        $response = $this->actingAs($this->user)->get("/authors/{$author->id}");

        $response->assertStatus(200);
        $response->assertSeeTextInOrder([$author->first_name, $author->last_name]);
    }

    public function test_create_author_form_exists()
    {
        $response = $this->actingAs($this->user)->get('/authors/create');

        $response->assertStatus(200);
    }

    public function test_store_author_validations_fail_when_fields_empty()
    {
        $author = [
            'first_name' => '',
            'last_name' => '',
        ];

        $response = $this->actingAs($this->user)->post('/authors', $author);

        $response->assertInvalid(['first_name', 'last_name']);
    }

    public function test_store_author_validations_fail_when_fields_not_alfa()
    {
        $author = [
            'first_name' => '123',
            'last_name' => '123',
        ];

        $response = $this->actingAs($this->user)->post('/authors', $author);

        $response->assertInvalid(['first_name', 'last_name']);
    }

    public function test_store_author()
    {
        $author = [
            'first_name' => 'Bilbo',
            'last_name' => 'Baggins',
        ];
        $this->assertDatabaseMissing('authors', $author);

        $response = $this->actingAs($this->user)->post('/authors', $author);

        $latestAuthor = Author::orderBy('id', 'desc')->first();
        $response->assertRedirectToRoute('authors.show', ['author' => $latestAuthor]);
        $this->assertDatabaseHas('authors', $author);
    }

    public function test_update_author_form_exists()
    {
        $author = Author::factory()->create();

        $response = $this->actingAs($this->user)->get("/authors/{$author->id}/edit");

        $response->assertStatus(200);
        $response->assertSee($author->first_name);
        $response->assertSee($author->last_name);
        $response->assertViewHas('author', $author);
    }

    public function test_update_author()
    {
        $originalAuthorData = [
            'first_name' => 'Frodo',
            'last_name' => 'Baggins',
        ];
        $editedAuthorData = [
            'first_name' => 'Freddy',
            'last_name' => 'Boffin',
        ];
        $author = Author::create($originalAuthorData);

        $response = $this->actingAs($this->user)->put("/authors/{$author->id}", $editedAuthorData);

        $response->assertRedirectToRoute('authors.show', ['author' => $author]);
        $this->assertDatabaseHas('authors', $editedAuthorData);
        $this->assertDatabaseMissing('authors', $originalAuthorData);
    }

    public function test_delete_author()
    {
        $author = Author::factory()->hasBooks(3)->create();

        $response = $this->actingAs($this->user)->delete("/authors/{$author->id}");

        $response->assertStatus(302);
        $response->assertRedirectToRoute('dashboard');
        $this->assertDatabaseMissing('authors', $author->toArray());
        $this->assertDatabaseCount('authors', 0);
        $this->assertDatabaseCount('books', 0);
    }
}
