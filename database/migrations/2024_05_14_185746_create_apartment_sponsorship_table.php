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
        Schema::create('apartment_sponsorship', function (Blueprint $table) {
            
            $table->foreignId('apartment_id')->constrained()->cascadeOnDelete();
            $table->foreignId('sponsorship_id')->constrained()->cascadeOnDelete();
            $table->date('start_date');
            $table->date('end_date');
            $table->primary(['apartment_id', 'sponsorship_id']);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apartment_sponsorship');
    }
};
