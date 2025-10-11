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
        Schema::create('victory_groups', function (Blueprint $table) {
            $table->id()->primary();
            $table->timestamps();
            $table->string('life_walk');
            $table->string('vg_lead');
            $table->string('vg_mem');
            $table->string('freq');
            $table->string('loc');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('victory_groups');
    }
};
