<?php

namespace Tests\Unit;

use App\Models\Raffle;
use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TicketTest extends TestCase
{
    use RefreshDatabase; // Esto asegura que la base de datos se reinicie después de cada prueba

    /** @test */
    public function checkTicketExists()
    {
        $this->withoutMiddleware();
        // Simular datos de solicitud para crear un ticket
        $requestData = [
            'id' => "LG999",
            'purchase_date' => now()->format('Y-m-d'),
            'selected_numbers' => '1 - 2 - 3 - 4 - 5',
            'luck' => true,
        ];

        // Actualizar la prueba unitaria en TicketControllerTest.php
        $response = $this->post('/comprar-billete', $requestData);

        $response->assertRedirect(); // Verificar que se realiza una redirección

// Seguir la redirección y verificar la sesión en la nueva respuesta
        $response = $this->get($response->headers->get('Location'));
        $response->assertSessionHas('purchase_successful', true);

        // Verificar que se haya creado una raffle si no existía previamente
        $this->assertDatabaseHas('raffles', [
            'date_raffle' => now()->next(Carbon::SUNDAY)->format('Y-m-d H:i'), // Asegúrate de ajustar según tu lógica de fecha
            'number_of_tickets' => 1, // Puedes ajustar estos valores según tu lógica de negocio
            'total' => 3000, // Puedes ajustar estos valores según tu lógica de negocio
            'total_luck' => 1000, // Puedes ajustar estos valores según tu lógica de negocio
            'subtotal_of_tickets' => 2000, // Puedes ajustar estos valores según tu lógica de negocio
            'status_raffle' => 0, // Puedes ajustar estos valores según tu lógica de negocio
            'luck_raffle' => 1, // Puedes ajustar estos valores según tu lógica de negocio
        ]);

        // Verificar que se haya creado el ticket correctamente
        $this->assertDatabaseHas('tickets', [
            'id' => "LG999",
            'date' => now()->format('Y-m-d'), // Asegúrate de ajustar según tu lógica de fecha
            'number_1' => 1,
            'number_2' => 2,
            'number_3' => 3,
            'number_4' => 4,
            'number_5' => 5,
            'luck' => true,
            'is_winner' => false,
            'is_luck_winner' => false,
        ]);
    }
}
