<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class InfernalTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function numberCheck()
    {
        // Simulate selecting 5 numbers
        $selected = [1, 3, 5, 7, 9];

        // Send a POST request to the route that handles the number selection
        $response = $this->post('/select-numbers', [
            'numbers' => $selected,
        ]);

        // Assert the response status and expected behavior
        $response->assertStatus(200);
        $response->assertJson([
            'message' => 'Success',
            'selected_numbers' => $selected,
        ]);
    }

    /** @test */
    public function notFive()
    {
        // Simulate selecting less than 5 numbers
        $Numbers = [1, 3, 5];

        // Send a POST request to the route that handles the number selection
        $response = $this->post('/select-numbers', [
            'numbers' => $Numbers,
        ]);

        // Assert the response status and expected error message
        $response->assertStatus(422);
        $response->assertJson([
            'message' => 'NOT ENOUGH NUMBERS',
        ]);
    }


        /** @test */
        public function nonUnique()
        {
            // Intencionalmente crear a un usuario ya existente
            User::create([
                'name' => 'Antonio Barraza Guzmán',
                'email' => 'antonio.barraza.guzman@gmail.com'

            ]);
    
            // Añadir a dicho usuario
            $response = $this->post('/add-sorter', [
                'name' => 'Antonio Barraza Guzmán',
                'email' => 'antonio.barraza.guzman@gmail.com'
            ]);

    
            // Assert the response status and expected error message
            $response->assertStatus(200);
            $response->assertJson(['message' => 'DUPLICATE FOUND']);
        }


}


