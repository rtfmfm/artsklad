<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableOrderedProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordered_products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id');
            $table->string('art', 32);
            $table->string('name', 128);
            $table->string('produser', 128);
            $table->string('unit', 32);
            $table->string('category', 128);
            $table->integer('fasovka');
            $table->decimal('price', 20,6);
            $table->integer('qty');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('odered_products');
    }
}
