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
        Schema::create('experiences', function (Blueprint $table) {
            $table->id();
            $table->integer('userid');
            $table->string('company');
            $table->string('jobTitle');
            $table->text('Duties');
            $table->date('startDate');
            $table->date('exitDate')->nullable();
            $table->string('exitReasons')->nullable();
            $table->binary('isCurrent');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('experiences');
    }
};
