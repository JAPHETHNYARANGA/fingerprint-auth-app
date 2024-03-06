<?php

namespace Tests\Feature\Controller;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class AuthenticationController extends TestCase
{
    use RefreshDatabase, WithFaker;
   
    public function test_user_can_login()
    {
        // Create a user for testing
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);

        // Make a POST request to the login endpoint
        $response = $this->post('/', [
            'email' => 'test@example.com',
            'password' => 'password',
        ]);

        // Assert that the user is redirected to the home page upon successful login
        $response->assertRedirect('/home');

        // Assert that the session contains a success message
        $this->assertTrue(session()->has('success'));

        // Assert that the authenticated user is the one created
        $this->assertTrue(Auth::check());
        $this->assertEquals($user->id, Auth::id());
    }

    public function test_user_cannot_login_with_invalid_credentials()
    {
        // Make a POST request to the login endpoint with invalid credentials
        $response = $this->post('/', [
            'email' => 'invalid@example.com',
            'password' => 'invalid_password',
        ]);

        // Assert that the user is redirected back to the login page
        $response->assertRedirect('/');

        // Assert that the session contains an error message
        $this->assertTrue(session()->has('error'));

        // Assert that the user is not authenticated
        $this->assertFalse(Auth::check());
    }

    public function test_user_can_register()
    {
        // Simulate form data
        $formData = [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => 'password',
            'fingerprint' => 'e123456gs56782', // Example fingerprint
        ];

        // Make a POST request to the register endpoint
        $response = $this->post('/register', $formData);

        // Assert redirect after successful registration
        $response->assertRedirect('/');

        // Assert session has success message
        $this->assertTrue(session()->has('success'));
    }

    /**
     * Test fetching user data.
     *
     * @return void
     */
    public function test_fetch_user_data()
    {
        // Create a user for testing
        $user = User::factory()->create();

        // Authenticate the user
        $this->actingAs($user);

        // Make a GET request to the fetch user endpoint
        $response = $this->get('/user');

        // Assert status code
        $response->assertStatus(200);

        // Assert response contains user data
        $response->assertSeeText($user->name);
        $response->assertSeeText($user->email);
    }
}
