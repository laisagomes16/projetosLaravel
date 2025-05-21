<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('projects')->insert([
            'nome' => 'Projeto ' .Str::random(2),
            'descricao' => 'Este projeto e referente: ' . Str::random(10)
        ]);
    }
}
