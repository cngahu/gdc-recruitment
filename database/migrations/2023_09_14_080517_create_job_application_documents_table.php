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
        Schema::create('job_application_documents', function (Blueprint $table) {
            $table->id();
            $table->integer('jobapplicationid');
            $table->integer('userid');
            $table->integer('vacancyid');
            $table->integer('path');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_application_documents');
    }
};
