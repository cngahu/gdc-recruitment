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
        Schema::create('leadership_courses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');  // Defining the user_id column
            $table->string('institutionName');
            $table->string('courseName');
            $table->date('startDate')->nullable();
            $table->date('exitDate');
            $table->string('grade')->nullable();
            $table->string('certNo');
            $table->string('certificate');
            $table->date('entryDate')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leadership_courses');
    }
};
