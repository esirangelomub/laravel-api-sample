<?php

namespace Tests\Feature\Controllers\V1;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CustomerControllerTest extends TestCase
{
    use WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_createCustomer()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
