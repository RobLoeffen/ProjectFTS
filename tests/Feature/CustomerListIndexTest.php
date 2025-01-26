<?php

namespace Tests\Feature;

use App\Models\Bus;
use App\Models\Festival;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CustomerListIndexTest extends TestCase
{
    use RefreshDatabase;

    public function test_employee_can_access_customer_list_page()
    {
        $user = User::factory()->create([
            'role' => 'employee'
        ]);

        $response = $this
            ->actingAs($user)
            ->get(route('CustomerList.index'));
        $response->assertStatus(200);
    }

    public function test_customer_cannot_access_customer_list_page()
    {
        $user = User::factory()->create([
            'role' => 'customer'
        ]);

        $response = $this
            ->actingAs($user)
            ->get(route('CustomerList.index'));
        $response->assertRedirect(route('dashboard'));
    }

    public function test_customer_list_displays_customer_information()
    {
        $user = User::factory()->create([
            'name' => 'Test Customer',
            'email' => 'test@example.com',
            'role' => 'employee',
            'points' => 100
        ]);

        $festival = Festival::factory()->create();
        $bus = Bus::factory()->create([
            'festival_id' => $festival->id
        ]);
        $user->buses()->attach($bus->id);

        $response = $this->actingAs($user)
            ->get(route('CustomerList.index'));

        $response->assertStatus(200);
        $response->assertSee('Test Customer');
        $response->assertSee('test@example.com');
        $response->assertSee('customer');
        $response->assertSee('100');
        $response->assertSee('Ride #' . $bus->id);
    }

    public function test_delete_customer_with_confirmation()
    {
        $user = User::factory()->create([
            'role' => 'employee'
        ]);

        $response = $this->actingAs($user)
            ->delete(route('CustomerList.destroy', $user));

        $response->assertRedirect();
        $this->assertDatabaseMissing('users', [
            'id' => $user->id
        ]);
    }

    public function test_delete_nonexistent_customer()
    {
        $user = User::factory()->create([
            'role' => 'employee'
        ]);

        $nonexistentId = 99999;

        $response = $this
            ->actingAs($user)
            ->delete(route('CustomerList.destroy', $nonexistentId));

        $response->assertRedirect(route('CustomerList.index'));
    }

    public function test_customer_with_no_planned_rides_shows_message()
    {
        $user = User::factory()->create([
            'name' => 'Customer Without Rides',
            'role' => 'employee'
        ]);

        $response = $this->actingAs($user)
            ->get(route('CustomerList.index'));

        $response->assertStatus(200);
        $response->assertSee('No planned rides');
    }
}
