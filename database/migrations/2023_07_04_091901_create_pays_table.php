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
        Schema::create('pays', function (Blueprint $table) {
            $table->id();
            $table->foreignId('structure_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->date('period_start');
            $table->date('period_end');
            $table->integer('hour_done')->nullable();
            $table->integer('overtime_done');
            $table->decimal('gross_wage', 10, 2);
            $table->decimal('net_wage', 10, 2);
            $table->unsignedBigInteger('created_by');
            $table->foreign('created_by')->references('id')->on('users')->constrained();
            $table->date('pay_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pays');
    }
};
