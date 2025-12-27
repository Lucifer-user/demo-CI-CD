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
        Schema::create('category_attributes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->string('attribute_name');        // "Màu sắc", "Dung tích"...
            $table->string('attribute_type')->default('text'); // "text", "select", "number"
            $table->boolean('is_required')->default(false);
            $table->json('options')->nullable();     // ["Đỏ", "Cam", "Hồng"] cho select
            $table->integer('sort_order')->default(0);
            $table->timestamps();
            
            $table->foreign('category_id')->references('id')->on('category')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_attributes');
    }
};
