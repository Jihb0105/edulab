<?php

namespace Tests\Unit;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_registration_page_can_be_rendered()
    {
        $response = $this->get('/register');
 
        $response->assertStatus(200);
    }

    public function test_new_users_registration_pass()
    {
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'birth_date' => '2001-12-30',
            'type' => '1',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $this->assertAuthenticated();
        // $response->assertRedirect(RouteServiceProvider::HOME);
    }

    public function test_new_users_registration_fail()
    {
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'birth_date' => '2001-12-30',
            'type' => '1',
            'password' => 'password',
            'password_confirmation' => 'passwords',
        ]);

        $this->assertAuthenticated();
        // $response->assertRedirect(RouteServiceProvider::HOME);
    }
    
}
