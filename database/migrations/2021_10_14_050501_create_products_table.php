<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {    
        Schema::enableForeignKeyConstraints();
        Schema::create('products', function (Blueprint $table) {

            
            $table->id();
            $table->string('name');
            $table->string('descreption');
            $table->float('discount', 10, 4);
            $table->float('Weight', 10, 4);
            $table->float('price', 10, 4);
            
            $table->foreignId('country_id')->constrained('countries');
            $table->foreignId('category_id')->constrained('categories');
            $table->foreignId('discount_id')->constrained('discounts');

            // $table->unsignedBigInteger('country_id');
            // $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');

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
