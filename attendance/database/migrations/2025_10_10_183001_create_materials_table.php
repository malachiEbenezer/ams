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
        Schema::create('materials', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('class');
            $table->string('type');
            $table->string('photo');
            $table->string('name');
            $table->string('desc');
            $table->float('price');
            $table->string('purchase_date');
            $table->string('release_date');
            $table->integer('qty');
            $table->string('status');
            $table->string('remarks');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materials');
    }
};
