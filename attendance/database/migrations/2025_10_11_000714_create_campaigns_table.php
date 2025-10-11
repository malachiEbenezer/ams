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
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('life_walk');
            $table->string('con_num');
            $table->string('email');
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('surname');
            $table->string('leader');
            $table->string('chapter');      
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaigns');
    }
};
