<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shopping', function (Blueprint $table) {
            $table->increments('shopping_id');
            $table->string('shopping_name');
            $table->integer('customer_id');
            $table->string('shopping_phone');
            $table->string('shopping_city');
            $table->string('shopping_province');
            $table->string('shopping_wards');
            $table->string('shopping_address');
       
            
          
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
        Schema::dropIfExists('shopping');
    }
};
