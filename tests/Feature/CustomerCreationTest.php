<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CustomerCreationTest extends TestCase
{
    use RefreshDatabase;

    public function test_employee_can_access_customer_creation_page()
    {
        $user = User::factory()->create([
            'role' => 'employee'
        ]);

        $response = $this
            ->actingAs($user)
            ->get(route('CustomerList.create'));
        $response->assertStatus(200);
    }

    public function test_customer_cannot_access_customer_creation_page()
    {
        $user = User::factory()->create([
            'role' => 'customer'
        ]);

        $response = $this
            ->actingAs($user)
            ->get(route('CustomerList.create'));
        $response->assertRedirect(route('dashboard'));
    }

    public function test_employee_can_create_customer_account()
    {
        $employee = User::factory()->create([
            'role' => 'employee'
        ]);

        $response = $this->actingAs($employee)->post(route('CustomerList.store'), [
            'name' => 'Test Customer',
            'email' => 'customer@test.com',
            'password' => 'password',
            'role' => 'customer'
        ]);

        $response->assertRedirect(route('CustomerList.index'));
        $this->assertDatabaseHas('users', [
            'email' => 'customer@test.com',
            'role' => 'customer'
        ]);
    }

    public function test_name_field_is_required()
    {
        $employee = User::factory()->create([
            'role' => 'employee'
        ]);

        $response = $this->actingAs($employee)->post(route('CustomerList.store'), [
            'email' => 'test@example.com',
            'password' => 'password',
            'role' => 'customer'
        ]);

        $response->assertSessionHasErrors('name');
    }

    public function test_email_must_be_valid()
    {
        $employee = User::factory()->create([
            'role' => 'employee'
        ]);

        $response = $this->actingAs($employee)->post(route('CustomerList.store'), [
            'name' => 'Test Customer',
            'email' => 'invalid-email',
            'password' => 'password',
            'role' => 'customer'
        ]);

        $response->assertSessionHasErrors('email');
    }

    public function test_email_must_be_unique()
    {
        $employee = User::factory()->create([
            'role' => 'employee'
        ]);

        // Create a user with the email we'll try to duplicate
        User::factory()->create([
            'email' => 'existing@example.com'
        ]);

        $response = $this->actingAs($employee)->post(route('CustomerList.store'), [
            'name' => 'Test Customer',
            'email' => 'existing@example.com',
            'password' => 'password',
            'role' => 'customer'
        ]);

        $response->assertSessionHasErrors('email');
    }

    public function test_password_minimum_length()
    {
        $employee = User::factory()->create([
            'role' => 'employee'
        ]);

        $response = $this->actingAs($employee)->post(route('CustomerList.store'), [
            'name' => 'Test Customer',
            'email' => 'test@example.com',
            'password' => 'short',
            'role' => 'customer'
        ]);

        $response->assertSessionHasErrors('password');
    }

    public function test_empty_form_submission()
    {
        $employee = User::factory()->create([
            'role' => 'employee'
        ]);

        $response = $this->actingAs($employee)->post(route('CustomerList.store'), []);

        $response->assertSessionHasErrors(['name', 'email', 'password', 'role']);
    }

}
