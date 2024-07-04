namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Http\Request;
use App\Http\Controllers\RegisterController;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use App\Mail\PasswordMailable;
use Exception;

class RegisterControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_shows_the_register_form()
    {
        $response = $this->get('/register');
        $response->assertStatus(200);
        $response->assertViewIs('auth.register');
        $response->assertSee('Register'); // Verifica que el título de la página se vea
        $response->assertSee('Name:'); // Verifica que el campo Name se vea
        $response->assertSee('Email:'); // Verifica que el campo Email se vea
        $response->assertSee('Age:'); // Verifica que el campo Age se vea
    }

    /** @test */
    public function it_registers_a_user_and_sends_an_email()
    {
        Mail::fake(); // Falsifica el envío de correo para pruebas

        $request = Request::create('/register', 'POST', [
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'age' => 25,
        ]);

        $controller = new RegisterController();

        $response = $controller->registerCreate($request);

        $this->assertEquals(302, $response->status()); // Verifica redirección
        $this->assertEquals(route('raffletors'), $response->headers->get('Location'));

        $this->assertDatabaseHas('users', [
            'email' => 'johndoe@example.com',
        ]);

        Mail::assertSent(PasswordMailable::class);
    }

    /** @test */
    public function it_fails_registration_due_to_validation_errors()
    {
        $this->withoutExceptionHandling();

        $request = Request::create('/register', 'POST', [
            'name' => '',
            'email' => 'invalid-email',
            'age' => 17,
        ]);

        $controller = new RegisterController();

        try {
            $controller->registerCreate($request);
        } catch (ValidationException $e) {
            $errors = $e->validator->errors();
            $this->assertEquals('El campo nombre es obligatorio.', $errors->first('name'));
            $this->assertEquals('El campo email debe ser una dirección de correo válida.', $errors->first('email'));
            $this->assertEquals('El campo edad debe ser al menos 18.', $errors->first('age'));
        }

        $this->assertNull(User::where('email', 'invalid-email')->first());
    }

    /** @test */
    public function it_fails_registration_due_to_email_already_taken()
    {
        User::create([
            'name' => 'Existing User',
            'email' => 'johndoe@example.com',
            'password' => bcrypt('password123'),
        ]);

        $request = Request::create('/register', 'POST', [
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'age' => 25,
        ]);

        $controller = new RegisterController();

        try {
            $controller->registerCreate($request);
        } catch (ValidationException $e) {
            $errors = $e->validator->errors();
            $this->assertEquals('El correo ya está en uso.', $errors->first('email'));
        }

        $this->assertCount(1, User::where('email', 'johndoe@example.com')->get());
    }
}
