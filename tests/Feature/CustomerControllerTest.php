<?php

namespace Tests\Feature\Controllers;

use Tests\TestCase;
use App\Models\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CustomerControllerTest extends TestCase
{
    use RefreshDatabase;

    public function it_can_fetch_all_customers()
    {
        Customer::factory()->create([
            'first_name' => 'Juan',
            'last_name' => 'cruz',
            'email' => 'juancruz@example.com',
            'country' => 'Philippines'
        ]);

        $response = $this->getJson('/api/customers');

        $response->assertStatus(200)
                 ->assertJsonFragment([
                     'first_name' => 'Juan',
                     'last_name' => 'cruz',
                     'email' => 'juancruz@example.com',
                     'country' => 'Philippines',
                 ]);
    }

    /** @test */
public function it_can_fetch_a_single_customer()
{
    $customer = Customer::factory()->create([
        'first_name' => 'Juan',
        'last_name' => 'cruz',
        'email' => 'juancruz@example.com',
        'username' => 'juancruz',
        'gender' => 'male',
        'country' => 'Philippiens',
        'city' => 'Batangas',
        'phone' => '09498662222',
    ]);

  
    dd($customer);

    $response = $this->getJson('/api/customers/' . $customer->id);
    dd($response->getContent());

    $response->assertStatus(200)
             ->assertJsonFragment([
                 'first_name' => 'Juan',
                 'last_name' => 'cruz',
                 'email' => 'juancruz@example.com',
                 'username' => 'juancruz',
                 'gender' => 'male',
                 'country' => 'Philippines',
                 'city' => 'Batangas',
                 'phone' => '09498662222',
             ]);
}
}
