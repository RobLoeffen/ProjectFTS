<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Bus;
use App\Models\Festival;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_customer_dashboard_display()
    {
        $customer = User::factory()->create(['role' => 'customer']);
        $festivals = Festival::factory()->count(4)->create();

        $buses = collect();
        foreach ($festivals as $festival) {
            $buses = $buses->concat(
                Bus::factory()->count(1)->create(['festival_id' => $festival->id])
            );
        }

        $customer->buses()->attach($buses);

        $response = $this->actingAs($customer)
            ->get(route('dashboard'));

        $response->assertStatus(200);
        $response->assertViewHas('festivals', $festivals);
        $response->assertSee('Your Upcoming Rides');
        $response->assertSee($buses[0]->departure_location);
        $response->assertSee(route('festivals'));
        $response->assertDontSee(route('CustomerList.index'));
    }

    public function test_employee_dashboard_display()
    {
        $employee = User::factory()->create(['role' => 'employee']);
        $festivals = Festival::factory()->count(5)->create();
        $otherUsers = User::factory()->count(4)->create();

        $allUsers = new Collection([$employee, ...$otherUsers]);

        $response = $this->actingAs($employee)
            ->get(route('dashboard'));

        $response->assertStatus(200);
        $response->assertViewHas('festivals', $festivals);
        $response->assertViewHas('users', $allUsers);
        $response->assertSee($otherUsers[0]->name);
        $response->assertSee(route('CustomerList.index'));
        $response->assertDontSee('Last Added Rides');
    }
}
