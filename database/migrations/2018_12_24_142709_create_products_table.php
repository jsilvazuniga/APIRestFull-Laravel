<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   /*120 es la longitud del campo*/
         /*unsigned(); solo valores positivos*/
         /*hara referencia a user como table principal
          - users es el nombre de la table en plural*/ 
         
         Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 120);
            $table->string('description', 1000);
            $table->integer('quantity')->unsigned();  
            $table->integer('status');
            $table->unsignedInteger('seller_id');
            $table->timestamps();

            $table->foreign('seller_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
