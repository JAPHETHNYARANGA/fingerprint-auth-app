<?php

namespace Tests\Unit\Models;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserModelTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    
    public function test_user_can_register(): void
    {
        // Create a new user instance
        $user = new User([
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('password'), 
            'fingerprint' => 'e123456gs56782',
        ]);
        
        // Save the user
        $user->save();

        // Check if the user was saved successfully
        $this->assertDatabaseHas('users', [
            'email' => $user->email,
        ]);
    }

    public function test_user_can_login(): void
    {
        // Create a new user
        $user = User::create([
            'name' => $this->faker->name,
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
            'fingerprint' => 'e123456gs56782',
        ]);

        // Attempt to login with email and password
        $response = $this->post('/', [
            'email' => 'test@example.com',
            'password' => 'password',
        ]);

        // Assert that the user is redirected to the home page upon successful login
        $response->assertRedirect('/home');

        // Retrieve the session data to check if the success message exists
        $this->assertTrue(session()->has('success'), 'Session does not contain success message');
        $this->assertEquals('User logged in successfully', session('success'));
    }


}
