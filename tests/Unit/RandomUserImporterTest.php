<?php

namespace Tests\Unit\Services;

use Tests\TestCase;
use App\Services\RandomUserImporter;
use Illuminate\Support\Facades\Http;
use App\Models\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RandomUserImporterTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function it_imports_customers_correctly()
    {
        Http::fake([
            'https://randomuser.me/api/*' => Http::response([
                'results' => [
                    [
                        'name' => ['first' => 'Juan', 'last' => 'cruz'],
                        'email' => 'juancruz@example.com',
                        'login' => ['username' => 'juancruz', 'password' => 'secret'],
                        'gender' => 'male',
                        'location' => [
                            'country' => 'Philippines',
                            'city' => 'Batangas'
                        ],
                        'phone' => '09498662222',
                    ],
                ],
            ], 200)
        ]);

        $importer = new RandomUserImporter();

        $importer->importCustomers();

        $this->assertDatabaseHas('customers', [
            'first_name' => 'Juan',
            'last_name' => 'cruz',
            'email' => 'juancruz@example.com',
            'username' => 'juancruz',
            'gender' => 'male',
            'country' => 'Philippines',
            'city' => 'Batangas',
            'phone' => '09498662222',
            'password' => md5('secret'),
        ]);
    }
}
