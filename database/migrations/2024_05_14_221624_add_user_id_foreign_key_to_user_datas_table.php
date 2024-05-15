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
        Schema::table('user_datas', function (Blueprint $table) {
                       
            $table->foreignId('user_id')->nullable()->constrained();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_datas', function (Blueprint $table) {
 
            // delete the add of foreign key
            $table->dropForeign('user_datas_user_id_foreign');

            // delete the column
            $table->dropColumn('user_id');
        });
    }
};
