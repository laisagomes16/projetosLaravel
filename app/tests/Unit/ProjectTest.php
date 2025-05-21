<?php

namespace Tests\Unit;

use App\Http\Requests\ProjectFormRequest;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {
        $this->assertTrue(true);
    }

    public function test_project_request_valid()
    {
        $data = ['name' => 'Projeto A', 'descricao' => 'Descrição breve'];
        $request = new ProjectFormRequest();
        $rules = $request->rules();

        $validator = Validator::make($data, $rules);
        $this->assertTrue($validator->passes());
    }

    public function test_project_request_invalid()
    {
        $data = [];
        $request = new ProjectFormRequest();
        $rules = $request->rules();

        $validator = Validator::make($data, $rules);
        $this->assertTrue($validator->fails());
    }
}
