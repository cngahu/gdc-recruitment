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
        Schema::create('proffessional_quals', function (Blueprint $table) {
            $table->id();
            $table->integer('userid');
            $table->string('institutionName');
            $table->string('courseName');
            $table->date('startDate');
            $table->date('exitDate');
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
        Schema::dropIfExists('proffessional_quals');
    }
};
