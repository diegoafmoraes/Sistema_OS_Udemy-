<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsuarioFakerSeeder extends Seeder
{
    public function run()
    {
        // Seeds (fake) ao BD
        $usuarioModel = new \App\Models\UsuarioModel();

        // https://github.com/fzaninotto/Faker
        // use the factory to create a Faker\Generator instance
        $faker = \Faker\Factory::create();

        $criarQuantosUsuarios = 5000; // 50;

        $usuariosPush = [];

        for($i = 0; $i < $criarQuantosUsuarios; $i++) {

            array_push($usuariosPush, [
                'nome'          => $faker->unique()->name,
                'email'         => $faker->unique()->email,
                'password_hash' => '123456', // alterar mais a frente quando conhecer como criptografar (hash)
                'ativo'         => $faker->numberBetween(0, 1) , // true ou false,
            ]);
        }

        /* DEBUG (TESTE)
        echo '<pre>';
        print_r($usuariosPush);
        exit; */

        // 'insertBatch' -> insere dados por "Batelada", ou grande volume de dados
        $usuarioModel->skipValidation(true) // bypass na validation
                     ->protect(false) // bypass nos campos de allowedFields (Model))
                     ->insertBatch($usuariosPush);

        echo "$criarQuantosUsuarios usuarios criados com sucesso";

    }
}
