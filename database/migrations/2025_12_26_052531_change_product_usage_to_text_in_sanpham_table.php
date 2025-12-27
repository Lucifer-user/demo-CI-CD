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
        try {
            DB::statement('ALTER TABLE sanpham ADD COLUMN product_usage TEXT NULL');
        } catch (\Throwable $e) {
            // If add fails (e.g. exists), try verify/modify type
            try {
                DB::statement('ALTER TABLE sanpham MODIFY product_usage TEXT NULL');
            } catch (\Throwable $e2) {}
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        try {
            DB::statement('ALTER TABLE sanpham DROP COLUMN product_usage');
            DB::statement('ALTER TABLE sanpham ADD COLUMN product_usage VARCHAR(255) NULL');
        } catch (\Throwable $e) {}
    }
};
