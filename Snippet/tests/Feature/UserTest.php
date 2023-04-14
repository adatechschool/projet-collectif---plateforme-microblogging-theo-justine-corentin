<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

use App\Providers\RouteServiceProvider;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function testMultiplication(): void {
        $this->assertEquals(4, 2*2);
    }
}
