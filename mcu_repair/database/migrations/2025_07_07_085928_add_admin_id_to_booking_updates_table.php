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
        Schema::table('booking_updates', function (Blueprint $table) {
            $table->foreignId('admin_id')
                  ->constrained('users','id')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('booking_updates', function (Blueprint $table) {
           $table->dropForeign(['admin_id']);
           $table->dropColumn('admin_id');
        });
    }
};
