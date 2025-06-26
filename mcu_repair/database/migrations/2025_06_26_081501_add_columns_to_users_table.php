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
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->unique()->after('id');
            $table->string('fullName')->after('username');
            $table->string('phone')->after('fullName');
            $table->string('position')->nullable()->after('phone');
            $table->string('personnel')->nullable()->after('position');
            $table->string('role')->default('USER')->after('personnel');
    
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['username', 'fullName', 'phone', 'position', 'personnel', 'role']);
        });
    }
};
