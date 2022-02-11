<?php

namespace Tests\Feature\Controllers\V1;

use App\Models\Customer;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CustomerControllerTest extends TestCase
{
    use WithFaker, DatabaseTransactions;

    protected $url = '/api/v1/customer/';

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_createCustomer()
    {
        $response = $this->withHeaders($this->defaultHeaders)->postJson($this->url, [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'phone' => $this->faker->phoneNumber,
            'address' => [
                'number' => $this->faker->numberBetween([10, 999]),
                'street_name' => $this->faker->streetName,
                'city' => $this->faker->city,
                'state' => $this->faker->locale,
                'country' => $this->faker->country
            ]
        ]);
        $response->assertStatus(201);
    }

    public function test_createCustomerWithErrors()
    {
        $response = $this->withHeaders($this->defaultHeaders)->postJson($this->url, [
            'email' => $this->faker->email,
            'phone' => $this->faker->phoneNumber,
            'address' => [
                'number' => $this->faker->numberBetween([10, 999]),
                'street_name' => $this->faker->streetName,
                'city' => $this->faker->city,
                'state' => $this->faker->locale,
                'country' => $this->faker->country
            ]
        ]);
        $response->assertStatus(400);
    }

    public function test_listCustomer()
    {
        $response = $this->withHeaders($this->defaultHeaders)->getJson($this->url);
        $response->assertStatus(200);
    }

    public function test_displayCustomer()
    {
        $id = Customer::latest('id')->first()->id;
        $response = $this->withHeaders($this->defaultHeaders)->getJson($this->url . $id);
        $response->assertStatus(200);
    }

    public function test_displayCustomerNotFound()
    {
        $response = $this->withHeaders($this->defaultHeaders)->getJson($this->url . '/0');
        $response->assertStatus(500);
    }

    public function test_updateCustomer()
    {
        $id = Customer::latest('id')->first()->id;
        $response = $this->withHeaders($this->defaultHeaders)->putJson($this->url . $id, [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'phone' => $this->faker->phoneNumber,
            'address' => [
                'number' => $this->faker->numberBetween([10, 999]),
                'street_name' => $this->faker->streetName,
                'city' => $this->faker->city,
                'state' => $this->faker->locale,
                'country' => $this->faker->country
            ]
        ]);
        $response->assertStatus(200);
    }

    public function test_deleteCustomer()
    {
        $id = Customer::latest('id')->first()->id;
        $response = $this->withHeaders($this->defaultHeaders)->deleteJson($this->url . $id);
        $response->assertStatus(200);
    }
}
