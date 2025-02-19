<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use App\Models\Customer;

class FetchCustomersTest extends TestCase
{
    use RefreshDatabase;
    public function test_fetch_customers_command()
    {
        // fake API
        Http::fake([
            'dummyjson.com/users' => Http::response([
                'users' => [
                    [
                        'email'     => 'peter.vavra01@gmail.com',
                        'firstName' => 'Peter',
                        'lastName'  => 'Vavra',
                        'birthDate' => '2001-08-14',
                    ],
                    [
                        'email'     => 'peter.vavra02@gmail.com',
                        'firstName' => 'Peter',
                        'lastName'  => 'Vavra',
                        'birthDate' => '2001-08-13',
                    ],
                ],
            ]),
        ]);

        // spusteie a overenie vystupu
        $this->artisan('app:fetch-customers')
             ->expectsOutput('zákazníci boli uspešné vložení')
             ->assertExitCode(0);

        // overenie vkladania
        $this->assertDatabaseHas('customers', [
            'email' => 'peter.vavra01@gmail.com',
            'name'  => 'Peter Vavra',
            'dob'   => '2001-08-14',
        ]);

        $this->assertDatabaseHas('customers', [
            'email' => 'peter.vavra02@gmail.com',
            'name'  => 'Peter Vavra',
            'dob'   => '2001-08-13',
        ]);
    }
}
