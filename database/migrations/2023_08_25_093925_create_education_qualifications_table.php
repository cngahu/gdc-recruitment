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
        Schema::create('education_qualifications', function (Blueprint $table) {
            $table->id();
            $table->integer('userid');
            $table->integer('acadiclevel');
            $table->date('startDate');
            $table->date('exitDate');
            $table->string('institutionName');
            $table->string('courseName');
            $table->integer('grade');
            $table->string('certNo');
            $table->string('certificate');
            $table->date('entryDate');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('education_qualifications');
    }
};
