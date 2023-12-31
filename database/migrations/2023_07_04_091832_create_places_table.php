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
        Schema::create('places', function (Blueprint $table) {
            $table->id();
            $table->foreignId('structure_id')->constrained();
            $table->foreignId('department_id')->nullable()->constrained();
            $table->string('name');
            $table->decimal('basis_wage', 10, 2);
            $table->decimal('hourly_rate', 10, 2)->nullable();
            $table->decimal('overtime_rate', 10, 2)->nullable();
            $table->decimal('overtime_rate_week', 10, 2)->nullable();
            $table->softDeletes();    
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('places');
    }
};
