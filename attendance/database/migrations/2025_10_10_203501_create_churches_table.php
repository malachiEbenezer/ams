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
        Schema::create('churches', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            
            //Personal Details
            $table->string('life_walk');
            $table->string('connect');
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('surname');
            $table->string('sex');
            $table->string('birthdate');
            $table->string('con_num');
            $table->string('email');
            $table->string('fb_acc');
            $table->string('address');

            //Engagements
            $table->string('life_grp');
            $table->string('victory_grp');
            $table->string('one_to_one');
            $table->string('purple_book');
            $table->string('church_com');
            $table->string('make_disc');
            $table->string('emp_leaders');
            $table->string('lead_113');
            $table->string('lead_215');

            $table->string('life_lead');
            $table->string('vg_lead');
            $table->string('one_lead');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('churches');
    }
};
