<?php

namespace Tests\Feature;

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

    public function test_index_page_exists()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/authors');

        $response->assertStatus(200);

        $response->assertSeeTextInOrder(['Dashboard', 'Author', 'Book']);
    }
}
