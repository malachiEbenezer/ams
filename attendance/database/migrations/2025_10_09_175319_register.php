<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\Sex;
use Filament\Forms\Components\Select;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('registers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('photo')->nullable();
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('surname');
            $table->string('suffix')->nullable();
            $table->string('sex');
            $table->integer('age');
            $table->date('birthdate');
            $table->string('school');
            $table->string('level');
            $table->string('year');
            $table->string('course');

            //COntact Details
            $table->string('con_num'); // contact number
            $table->string('email')->unique();
            $table->string('fb_acc')->nullable();

            // Address Info
            $table->string('region');
            $table->string('province');
            $table->string('city');
            $table->string('brgy');
            $table->string('add_spec')->nullable(); // specific address details

            // Emergency Contact
            $table->string('emer_relation');
            $table->string('emer_name');
            $table->string('emer_con'); // emergency contact number
            $table->string('emer_address');

            // Engagement (checkboxes)
            $table->boolean('en_orient')->default(false);     // Orientation
            $table->boolean('en_heads')->default(false);      // Heads
            $table->boolean('en_scard')->default(false);      // Student Card
            $table->boolean('en_tutorials')->default(false);  // Tutorials

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registers');
    }
};
