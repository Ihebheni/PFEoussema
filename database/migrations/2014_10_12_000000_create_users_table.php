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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->text('profile_photo')->nullable();
            $table->text('couverture_pic')->nullable();
            $table->enum('role', ['admin', 'coach', 'user'])->default('user');
            $table->enum('sexe', ['male', 'female']);
            $table->enum('civility', ['Mr', 'Ms', 'Dr', 'Prof'])->nullable(); // Feel free to modify default values
            $table->string('phone')->nullable();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('attendance_mode')->nullable();
            $table->string('occupation')->nullable();
            $table->string('company_name')->nullable();
            $table->string('sector')->nullable();
            $table->text('activity_description')->nullable();
            $table->boolean('email_subscription');
            $table->boolean('accepted_terms');
            $table->boolean('isactivated')->default(true);
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('instagram')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('cin')->nullable();
            $table->string('secondname')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
