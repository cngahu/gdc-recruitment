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
        Schema::create('selection_d_b_queries', function (Blueprint $table) {
            $table->id();
            $table->integer('vacancyid');
            $table->integer('userid');
            $table->text('query');
            $table->string('bindings');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('selection_d_b_queries');
    }
};
