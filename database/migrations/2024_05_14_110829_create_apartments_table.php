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
        Schema::create('apartments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->costrained();
            $table->string('name');
            $table->text('image');
            $table->tinyInteger('room_number');
            $table->tinyInteger('bed_number');
            $table->tinyInteger('bathroom_number');
            $table->smallInteger('square_meters');
            $table->string('address');
            $table->decimal('latitude' ,8, 6);
            $table->decimal('longitude', 9, 6);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apartments');
    }
};
