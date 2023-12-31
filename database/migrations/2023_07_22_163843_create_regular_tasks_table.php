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
        Schema::create('regular_tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('structure_id')->constrained();
            $table->string('frequency');
            $table->time('task_hour')->nullable();
            $table->string('task_day')->nullable();
            $table->string('task');
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('regular_tasks');
    }
};
