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
        Schema::create('sanpham', function (Blueprint $table) {
         $table->increments('product_id');
        $table->integer('id'); 
        $table->integer('brand_id');
        $table->string('product_name');
        $table->string('product_image')->nullable(); 
        $table->string('product_price'); 
        $table->string('product_sale_price')->nullable(); 
        $table->integer('product_stock');
        $table->string('product_status'); 
        $table->text('product_description')->nullable();
        $table->text('product_ingredient')->nullable();
        $table->string('product_weight')->nullable(); 
        $table->string('product_origin')->nullable();
        $table->string('product_expiry')->nullable(); 
        $table->text('product_usage')->nullable();
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
        Schema::dropIfExists('sanpham');
    }
};
