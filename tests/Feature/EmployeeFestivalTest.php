<?php

namespace Tests\Feature;

use App\Models\Festival;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EmployeeFestivalTest extends TestCase
{
    use RefreshDatabase;

//This test checks whether a user with the employee role can access the festivals page
    public function test_employee_can_access_festivals_page()
    {
        $user = User::factory()->create([
            'role' => 'employee'
        ]);

        $response = $this
            ->actingAs($user)
            ->get(route('Festivals.index'));
        $response->assertStatus(200);
    }

    // This test checks whether a user with the customer role is correctly redirected to the dashboard blade
    public function test_customer_cannot_access_festivals_page()
    {
        $user = User::factory()->create([
            'role' => 'customer'
        ]);

        $response = $this
            ->actingAs($user)
            ->get(route('Festivals.index'));

        $response->assertRedirect(route('dashboard'));
    }

    //
    public function test_add_new_festival()
    {
        $user = User::factory()->create([
            'role' => 'employee'
        ]);

        $response = $this
            ->actingAs($user)
            ->post(route('Festivals.store'), [
                'title' => 'test',
                'description' => 'test',
            ]);

        $response->assertRedirect(route('Festivals.index'));
        $this->assertDatabaseHas('festivals', [
            'title' => 'test',
            'description' => 'test',
        ]);
    }

    public function test_edit_festival()
    {
        $user = User::factory()->create([
            'role' => 'employee'
        ]);

        $festival = Festival::factory()->create([
            'title' => 'original',
            'description' => 'original',
        ]);

        $response = $this
            ->actingAs($user)
            ->put(route('Festivals.update', $festival), [
                'title' => 'test1',
                'description' => 'test1',
            ]);

        $response->assertRedirect(route('Festivals.index'));
        $this->assertDatabaseHas('festivals', [
            'id' => $festival->id,
            'title' => 'test1',
            'description' => 'test1',
        ]);
    }

    public function test_edit_nonexistent_festival()
    {
        $user = User::factory()->create([
            'role' => 'employee'
        ]);

        $nonexistentId = 99999;

        $response = $this
            ->actingAs($user)
            ->put(route('Festivals.update', $nonexistentId), [
                'title' => 'test1',
                'description' => 'test1',
            ]);

        $response->assertRedirect(route('Festivals.index'));
    }

    public function test_delete_festival()
    {
        $user = User::factory()->create([
            'role' => 'employee'
        ]);

        $festival = Festival::factory()->create();

        $response = $this
            ->actingAs($user)
            ->delete(route('Festivals.destroy', $festival));

        $response->assertRedirect(route('Festivals.index'));
        $this->assertDatabaseMissing('festivals', [
            'id' => $festival->id,
        ]);
    }

    public function test_delete_nonexistent_festival()
    {
        $user = User::factory()->create([
            'role' => 'employee'
        ]);

        $nonexistentId = 99999;

        $response = $this
            ->actingAs($user)
            ->delete(route('Festivals.destroy', $nonexistentId));

        $response->assertRedirect(route('Festivals.index'));
    }
}
