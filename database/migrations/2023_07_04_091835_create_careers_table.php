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
        Schema::create('careers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('place_id')->constrained();
            $table->string('birthday');
            $table->string('marital_status');
            $table->string('sex');
            $table->integer('child');
            $table->string('contact');
            $table->string('diploma');
            $table->string('contract');
            $table->date('contract_start');
            $table->date('contract_end')->nullable();            
            $table->date('dismissal')->nullable();
            $table->softDeletes();           
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('careers');
    }
};
