<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('leaves', function (Blueprint $table) {
            $table->id();
            $table->foreignId('structure_id')->constrained();
            $table->foreignId('leave_type_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->date('date_start');
            $table->time('hour_start');
            $table->date('date_end');
            $table->time('hour_end');
            $table->unsignedBigInteger('temp_worker');
            $table->foreign('temp_worker')->references('id')->on('users')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leaves');
    }
};
