<?php

namespace Tests\Feature;

use Tests\TestCase;

/**
 * @internal
 *
 * @coversNothing
 */
class BookTest extends TestCase
{
    public function test_index_page_exists()
    {
        $response = $this->get('/books');

        $response->assertStatus(200);
    }
}
