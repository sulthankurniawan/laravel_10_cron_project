<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('daily_records', function (Blueprint $table) {
            $table->date('date')->primary();
            $table->integer('male_count')->default(0);
            $table->integer('female_count')->default(0);
            $table->float('male_avg_age')->default(0);
            $table->float('female_avg_age')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_records');
    }
};
