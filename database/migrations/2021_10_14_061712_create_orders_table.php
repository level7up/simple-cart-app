<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            // $table->unsignedBigInteger('country_id');
            // $table->foreign('country_id')->references('id')->on('countries');
            $table->foreignId('country_id')->constrained('countries');

            // $table->unsignedBigInteger('category_id');
            $table->foreignId('category_id')->constrained('categories');
            
            // $table->unsignedBigInteger('discount_id');
            $table->foreignId('discount_id')->constrained('discounts');

            $table->float('total', 10, 4);

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
        Schema::dropIfExists('orders');
    }
}
