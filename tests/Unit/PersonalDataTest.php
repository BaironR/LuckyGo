<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mockery;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class PersonalDataTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp (): void
    {
        parent::setUp();
        $this->artisan('migrate');
    }

    public function test_datos_invalidos()
    {

        $user = new User(['name' => 'Pedro', 'age' => 30]);

        Auth::shouldReceive('user')->andReturn($user);

        $request = Request::create('/updateProfile', 'POST', [
            'name' => '',
            'age' => 'aaaaaa',
        ]);

        $controller = new UserController();

        try {
            $controller->updateProfile($request);
        } catch (ValidationException $e) {
            $errors = $e->validator->errors();
            $this->assertArrayHasKey('name', $errors->messages());
            $this->assertArrayHasKey('age', $errors->messages());
        }
    }
}

