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
            $table->string('identity_card')->unique()->nullable();
            $table->foreignId('speciality_id')->nullable()->constrained()->onDelete('cascade');
            $table->date('birthday')->nullable();
            $table->boolean('status')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['speciality_id']);
            
            $table->dropColumn('identity_card');
            $table->dropColumn('speciality_id');
            $table->dropColumn('birthday');
            $table->dropColumn('status');
        });
    }
};

