<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNullableToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('produser', 128)->nullable()->change();
            $table->string('country', 80)->nullable()->change();
            $table->string('unit', 32)->nullable()->change();
            $table->decimal('price', 20,6)->nullable()->change();
            $table->string('groop1', 128)->nullable()->change();
            $table->string('groop2', 128)->nullable()->change();
            $table->string('groop3', 128)->nullable()->change();
            $table->string('groop4', 128)->nullable()->change();
            $table->string('groop5', 128)->nullable()->change();
            $table->integer('fasovka')->nullable()->change();
            $table->integer('qty')->nullable()->change();
            $table->integer('min_qty')->nullable()->change();
            $table->text('text')->nullable()->change();
            $table->integer('sklad')->nullable()->change();
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
