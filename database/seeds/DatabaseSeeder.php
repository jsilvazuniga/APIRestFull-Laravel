<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

use App\User;
use App\Category;
use App\Transaction;
use App\Product;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        //desactivando relaciones
        Schema::disableForeignKeyConstraints();
        
        /*eliminando datos de las tablas*/
        User::truncate(); 
        Category::truncate();
        Transaction::truncate();
        Product::truncate();
        
        //eliminando datos de la tabla pivote
        DB::table('category_product')->truncate();
        
        //incando factoris
        $cantUsers = 1000;
        $cantCategories = 30;
        $cantProducts = 1000;
        $cantTransactions = 500;

        //creando usuarios aleatorios a la base de datos
        factory(User::class, $cantUsers)->create();
        //creando categorias aleatorios a la base de datos
        //recuperando los datos en una variable
        $categories = factory(Category::class, $cantCategories)->create();
        //creando productos
        factory(Product::class, $cantProducts)->create()->each(
            function($product) use($categories){
                    //recuperando de una lista aleatoria de 5 categorias un id
                   $randomCategories = $categories->random(mt_rand(1,5))->pluck('id');
                   $product->categories()->attach($randomCategories); 
            }
        );
        //creando transactiones aleatorias
        factory(Transaction::class, $cantTransactions)->create();

        //activando relaciones
        Schema::enableForeignKeyConstraints();
    }
}
