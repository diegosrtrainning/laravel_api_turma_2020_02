<?php

use Illuminate\Database\Seeder;

class ProdutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $produtos = factory(App\Produto::class, 20)->make();

        foreach ($produtos as $produto) {
            App\Produto::create([
                'nome'=>$produto->nome,
                'categoria'=>$produto->categoria,
                'valor'=>$produto->valor
            ]);
        }
    }
}
