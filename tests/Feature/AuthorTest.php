<?php

namespace Tests\Feature;

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
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_index_page_exists()
    {
        $response = $this->get('/authors');

        $response->assertStatus(200);
    }
}
