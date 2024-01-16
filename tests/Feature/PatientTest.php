<?php

namespace Tests\Feature;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\Withfake;
use Tests\TestCase;

class PatientTest extends TestCase
{
    use RefreshDatabase;

    public function test_empty_patient(): void
    {

        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get('/dashboard/patients');

        $response->assertStatus(200);
        $response->assertSee('There is no patient');
    }

    public function test_create_patient(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $data = [
            'name' => fake()->name(),
            'date_of_birth' => fake()->date(),
            'gender' => fake()->randomElement(['male', 'female']),
            'address' => fake()->address(),
            'contact' => fake()->phoneNumber(),
        ];

        $response = $this->post('/dashboard/patients', $data);

        $response->assertStatus(302);
        $response->assertRedirect('/dashboard/patients');

        $this->assertDatabaseHas('patients', $data);
    }


    public function test_non_empty_patient(): void
    {   
        $user = User::factory()->create();
        $this->actingAs($user);

        Patient::factory(10)->create();

        $response = $this->get('/dashboard/patients');

        $response->assertStatus(200);
        $response->assertDontSee('There is no patient');
    }

    public function test_patient_with_search_result(){
        $user = User::factory()->create();
        $this->actingAs($user);

        $searchTerm = 'dr';
        Patient::factory(10)->create([
            'name' => $searchTerm . fake()->name()
        ]);
        $response = $this->get('/dashboard/patients?search='.$searchTerm);
        $response->assertStatus(200);
        
        $response->assertSee($searchTerm);
        
    }

    public function test_delete_patient(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $patient = Patient::factory()->create();

        $response = $this->delete("/dashboard/patients/{$patient->id}");

        $response->assertStatus(302); // Assuming successful deletion redirects to another page
        $response->assertRedirect('/dashboard/patients'); // Adjust the redirect URL as needed

        $this->assertDatabaseMissing('patients', ['id' => $patient->id]);
    }

    public function test_update_patient(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $patient = Patient::factory()->create();

        $data = [
            'name' => fake()->name(),
            'date_of_birth' => fake()->date(),
            'gender' => fake()->randomElement(['male', 'female']),
            'address' => fake()->address(),
            'contact' => fake()->phoneNumber(),
        ];

        $response = $this->put("/dashboard/patients/{$patient->id}", $data);

        $response->assertStatus(302);
        $response->assertRedirect('/dashboard/patients');

        $this->assertDatabaseHas('patients', [
            'id' => $patient->id,
            'name' => $data['name'],
            'date_of_birth' => $data['date_of_birth'],
            'gender' => $data['gender'],
            'address' => $data['address'],
            'contact' => $data['contact'],
        ]);
    }


}
