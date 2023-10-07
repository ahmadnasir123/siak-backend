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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->integer('nis')->unique();
            $table->integer('nisn');
            $table->string('name');
            $table->string('gender')->nullable();
            $table->integer('age')->nullable();
            $table->string('jurusan')->nullable();
            $table->string('name_ortu')->nullable();
            $table->string('phone_ortu')->nullable();
            $table->string('tahun_masuk')->nullable();
            $table->string('tahun_lulus')->nullable();

            $table->boolean('is_verified')->default(false);
            $table->timestamp('verified_at')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
