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
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('art', 32);
            $table->string('name', 128);
            $table->string('produser', 128);
            $table->string('country', 80);
            $table->string('unit', 32);
            $table->decimal('price', 20,6);
            $table->string('groop1', 128);
            $table->string('groop2', 128);
            $table->string('groop3', 128);
            $table->string('groop4', 128);
            $table->string('groop5', 128);
            $table->integer('fasovka');
            $table->integer('qty');
            $table->integer('min_qty');
            $table->text('text');
            $table->integer('sklad');
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
        Schema::dropIfExists('products');
    }
}
