<?php

namespace Tests\Unit;

use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {
        $this->assertTrue(true);
    }

    public function test_user_valid()
    {
        $data = [
            'name' => 'Fulano',
            'email' => 'fulano@gmail.com',
            'password' => '123456',
            'password_confirmation' => '123456',
        ];

        $request = new UserRequest();
        $rules = $request->rules();

        $validator = Validator::make($data, $rules);
        $this->assertTrue($validator->passes());
    }

    public function test_user_invalid()
    {
        $data = [
            'name' => 'Fulano',
            'email' => 'sem_email',
            'password' => '123',
            'password_confirmation' => '123',
        ];

        $request = new UserRequest();
        $rules = $request->rules();

        $validator = Validator::make($data, $rules);
        $this->assertTrue($validator->fails());
    }

    public function test_user_password_confirm_invalid()
    {
        $data = [
            'name' => 'Fulano',
            'email' => 'fulano@email.com',
            'password' => '123',
            'password_confirmation' => '1234',
        ];

        $request = new UserRequest();
        $rules = $request->rules();

        $validator = Validator::make($data, $rules);
        $this->assertTrue($validator->fails());
    }
}
