<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CustomerEditTest extends TestCase
{
    use RefreshDatabase;

    public function test_employee_can_access_customer_creation_page()
    {
        $employee = User::factory()->create([
            'role' => 'employee'
        ]);

        $customer = User::factory()->create();

        $response = $this
            ->actingAs($employee)
            ->get(route('CustomerList.edit', ['CustomerList' => $customer->id]));
        $response->assertStatus(200);
    }

    public function test_customer_cannot_access_customer_creation_page()
    {
        $customer = User::factory()->create([
            'role' => 'customer'
        ]);

        $otherCustomer = User::factory()->create();

        $response = $this
            ->actingAs($customer)
            ->get(route('CustomerList.edit', ['CustomerList' => $otherCustomer->id]));
        $response->assertRedirect(route('dashboard'));
    }

    public function test_edit_nonexistent_customer_returns_redirect()
    {
        $employee = User::factory()->create([
            'role' => 'employee'
        ]);

        $response = $this
            ->actingAs($employee)
            ->get(route('CustomerList.edit', 999));
        $response->assertRedirect(route('CustomerList.index'));
    }

    public function test_email_validation_displays_error_message()
    {
        $employee = User::factory()->create([
            'role' => 'employee'
        ]);

        $customer = User::factory()->create();

        $response = $this
            ->actingAs($employee)
            ->put(route('CustomerList.update', $customer), [
                'name' => 'Test Name',
                'email' => 'invalid-email',
                'role' => 'customer',
                'points' => 100
            ]);

        $response->assertSessionHasErrors('email');
        $response->assertStatus(302);
    }

    public function test_all_fields_update_successfully()
    {
        $employee = User::factory()->create([
            'role' => 'employee'
        ]);

        $customer = User::factory()->create([
            'name' => 'Old Name',
            'email' => 'old@email.com',
            'role' => 'customer',
            'points' => 0
        ]);

        $response = $this
            ->actingAs($employee)
            ->put(route('CustomerList.update', $customer), [
                'name' => 'New Name',
                'email' => 'new@email.com',
                'role' => 'employee',
                'points' => 100
            ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('users', [
            'id' => $customer->id,
            'name' => 'New Name',
            'email' => 'new@email.com',
            'role' => 'employee',
            'points' => 100
        ]);
    }

    public function test_negative_points_validation_displays_error_message()
    {
        $employee = User::factory()->create([
            'role' => 'employee'
        ]);

        $customer = User::factory()->create();

        $response = $this
            ->actingAs($employee)
            ->put(route('CustomerList.update', $customer), [
                'name' => 'Test Name',
                'email' => 'test@email.com',
                'role' => 'customer',
                'points' => -50
            ]);

        $response->assertSessionHasErrors('points');
        $response->assertStatus(302);
    }

    public function test_empty_name_validation_displays_error_message()
    {
        $employee = User::factory()->create([
            'role' => 'employee'
        ]);

        $customer = User::factory()->create();

        $response = $this
            ->actingAs($employee)
            ->put(route('CustomerList.update', $customer), [
                'name' => '',
                'email' => 'test@email.com',
                'role' => 'customer',
                'points' => 100
            ]);

        $response->assertSessionHasErrors('name');
        $response->assertStatus(302);
    }

}
