<?php

namespace Tests\Feature;

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
}
