<?php

use Illuminate\Database\Seeder;

class ProductosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('productos')->insert([
            'Nombre'=> 'Mac'
        ]);
        DB::table('productos')->insert([
            'Nombre'=> 'Skate futurista',
        ]);
        DB::table('productos')->insert([
            'Nombre'=> 'Carro'
        ]);
        DB::table('productos')->insert([
            'Nombre'=> 'Pc Gamer'
        ]);
        DB::table('productos')->insert([
            'Nombre'=> 'Cellphone'
        ]);
        DB::table('productos')->insert([
            'Nombre'=> 'Iphone'
        ]);
         DB::table('productos')->insert([
            'Nombre'=> 'Huawei'
        ]);
        DB::table('productos')->insert([
            'Nombre'=> 'MinePoke'
        ]);   

        $producto = factory(App\Productos::class, 5)->create();
    }
}
