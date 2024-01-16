<?php

namespace Tests\Feature;
use App\Models\Patient;
use App\Models\User;
use App\Models\Appointment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AppointmentTest extends TestCase
{
    use RefreshDatabase;

    public function test_empty_appointment(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get('/dashboard/appointments');

        $response->assertStatus(200);
        $response->assertSee('There is no appointment');
    }

    public function test_create_appointment(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $patient = Patient::factory()->create();

        $data = [
            'patient_id' => $patient->id,
            'schedule' => fake()->date(),
            'status' => fake()->randomElement(['waiting', 'canceled']),
            'note' => fake()->sentence(),
        ];

        $response = $this->post('/dashboard/appointments', $data);

        $response->assertStatus(302);
        $response->assertRedirect('/dashboard/appointments');

        $this->assertDatabaseHas('appointments', $data);
    }

    public function test_cancel_appointment(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $patient = Patient::factory()->create();
        $appointment = Appointment::factory()->create([
            'patient_id' => $patient->id
        ]);
       
        $this->assertDatabaseHas('appointments', [
            'id' => $appointment->id,
            'status' => 'waiting',
        ]); 

        $response = $this->put("/dashboard/appointments/{$patient->id}");

        $response->assertStatus(302);
        $response->assertRedirect('/dashboard/appointments');

        $this->assertDatabaseHas('appointments', [
            'id' => $appointment->id,
            'status' => 'canceled',
        ]);
        
    }
}
