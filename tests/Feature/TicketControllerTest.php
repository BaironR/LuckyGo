<?php

namespace Tests\Feature;

use App\Models\Raffle;
use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TicketControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_validates_the_request()
    {
        $response = $this->post('/tickets', []);

        $response->assertSessionHasErrors(['id', 'purchase_date', 'selected_numbers', 'luck']);
    }

    /** @test */
    public function it_creates_a_new_raffle_if_not_exists()
    {
        $this->post('/tickets', [
            'id' => '12345',
            'purchase_date' => '2024-06-30',
            'selected_numbers' => '1 - 2 - 3 - 4 - 5',
            'luck' => 1
        ]);

        $nextSunday = Carbon::parse('2024-06-30')->next(Carbon::SUNDAY);
        $this->assertDatabaseHas('raffles', [
            'date_raffle' => $nextSunday->toDateString(),
            'number_of_tickets' => 1,
            'total' => 3000,
            'total_luck' => 1000,
            'subtotal_of_tickets' => 2000,
            'luck_raffle' => 1
        ]);
    }

    /** @test */
    public function it_updates_an_existing_raffle()
    {
        $nextSunday = Carbon::parse('2024-06-30')->next(Carbon::SUNDAY);

        Raffle::create([
            'date_raffle' => $nextSunday,
            'number_of_tickets' => 1,
            'total' => 2000,
            'total_luck' => 0,
            'subtotal_of_tickets' => 2000,
            'luck_raffle' => 0
        ]);

        $this->post('/tickets', [
            'id' => '12345',
            'purchase_date' => '2024-06-30',
            'selected_numbers' => '1 - 2 - 3 - 4 - 5',
            'luck' => 1
        ]);

        $this->assertDatabaseHas('raffles', [
            'date_raffle' => $nextSunday->toDateString(),
            'number_of_tickets' => 2,
            'total' => 5000,
            'total_luck' => 1000,
            'subtotal_of_tickets' => 4000,
            'luck_raffle' => 1
        ]);
    }

    /** @test */
    public function it_creates_a_new_ticket()
    {
        $nextSunday = Carbon::parse('2024-06-30')->next(Carbon::SUNDAY);

        $this->post('/tickets', [
            'id' => '12345',
            'purchase_date' => '2024-06-30',
            'selected_numbers' => '1 - 2 - 3 - 4 - 5',
            'luck' => 1
        ]);

        $this->assertDatabaseHas('tickets', [
            'id' => '12345',
            'date' => '2024-06-30',
            'number_1' => 1,
            'number_2' => 2,
            'number_3' => 3,
            'number_4' => 4,
            'number_5' => 5,
            'luck' => 1,
            'is_winner' => 0,
            'date_raffle' => $nextSunday->toDateString()
        ]);
    }
}
