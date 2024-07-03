namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Http\Request;
use App\Http\Controllers\RegisterController;      
use App\Models\User;
use Illuminate\Validation\ValidationException;    
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerificationEmail;

class RegisterControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_shows_the_register_form()
    {
        $response = $this->get('/register');
        $response->assertStatus(200);
        $response->assertViewIs('register');
    }

    /** @test */
    public function it_registers_a_user_and_sends_an_email()
    {
        Mail::fake(); // Falsifica el envío de correo para pruebas

        $request = Request::create('/register', 'POST', [
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'age' => 25,
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $controller = new RegisterController();

        $response = $controller->registerCreate($request);

        // Comprobación de redirección (método alternativo para pruebas unitarias)
        $this->assertEquals(302, $response->status()); // Verifica redirección
        $this->assertEquals(url('/raffletors'), $response->headers->get('Location'));

        // Comprobación de que el usuario fue creado en la base de datos
        $this->assertDatabaseHas('users', [
            'email' => 'johndoe@example.com',
        ]);

        // Comprobación de que se envió un correo electrónico
        Mail::assertSent(VerificationEmail::class);
    }

    /** @test */
    public function it_fails_registration_due_to_validation_errors()
    {
        $this->withoutExceptionHandling(); // Esto muestra más detalles de los errores

        $request = Request::create('/register', 'POST', [
            'name' => '',
            'email' => 'invalid-email',
            'age' => 17,
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $controller = new RegisterController();

        try {
            $controller->registerCreate($request);
        } catch (ValidationException $e) {
            $this->assertEquals('El campo nombre es obligatorio.', $e->errors()['name'][0]);
            $this->assertEquals('El campo email debe ser una dirección de correo válida.', $e->errors()['email'][0]);
            $this->assertEquals('El campo edad debe ser al menos 18.', $e->errors()['age'][0]);
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
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $controller = new RegisterController();

        try {
            $controller->registerCreate($request);
        } catch (ValidationException $e) {
            $this->assertEquals('El correo ya está en uso.', $e->errors()['email'][0]);
        }

        $this->assertCount(1, User::where('email', 'johndoe@example.com')->get());
    }
}

