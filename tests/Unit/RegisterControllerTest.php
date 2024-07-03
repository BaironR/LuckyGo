<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\PasswordMailable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use App\Http\Controllers\RegisterController;
use Mockery;

class RegisterControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_shows_the_register_form()
    {
        $controller = new RegisterController();
        $response = $controller->registerForm();

        $this->assertEquals('auth.register', $response->name());
    }

    /** @test */
    public function it_registers_a_user_and_sends_an_email()
    {
        Mail::fake();

        $request = Request::create('/register', 'POST', [
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'age' => 25,
        ]);

        $controller = Mockery::mock(RegisterController::class)->makePartial();

        $controller->shouldReceive('makeMessagesRegister')->andReturn([]);
        $controller->shouldReceive('auth')->andReturnSelf();
        $controller->shouldReceive('attempt')->andReturn(true);

        $response = $controller->registerCreate($request);

        $response->assertRedirect(route('raffletors'));
        $this->assertDatabaseHas('users', [
            'email' => 'johndoe@example.com',
            'name' => 'John Doe',
            'age' => 25,
        ]);

        $user = User::where('email', 'johndoe@example.com')->first();
        $this->assertNotNull($user);

        Mail::assertSent(PasswordMailable::class, function ($mail) use ($user) {
            return $mail->hasTo($user->email);
        });

        $this->assertTrue(session()->has('username'));
        $this->assertEquals(session('username'), 'John Doe');
    }

    /** @test */
    public function it_fails_registration_due_to_validation_errors()
    {
        $request = Request::create('/register', 'POST', [
            'name' => '',
            'email' => 'invalid-email',
            'age' => 17,
        ]);

        $controller = new RegisterController();
        
        $response = $controller->registerCreate($request);

        $response->assertSessionHasErrors(['name', 'email', 'age']);
        $this->assertNull(User::where('email', 'invalid-email')->first());
    }

    /** @test */
    public function it_fails_registration_due_to_email_already_taken()
    {
        $user = User::factory()->create([
            'email' => 'johndoe@example.com',
        ]);

        $request = Request::create('/register', 'POST', [
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'age' => 25,
        ]);

        $controller = new RegisterController();

        $response = $controller->registerCreate($request);

        $response->assertSessionHasErrors(['email']);
    }
}
