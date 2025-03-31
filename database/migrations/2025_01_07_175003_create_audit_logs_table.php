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
        Schema::create('audit_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');  // User who performed the action
            $table->string('activity_type');  // Type of activity (e.g., created, updated, deleted)
            $table->text('activity_description');  // Description of the action (optional details)
            $table->string('table_name');  // Affected table (e.g., 'users', 'applications')
            $table->unsignedBigInteger('record_id');  // The specific record affected (e.g., user ID, application ID)
            $table->string('ip_address', 45);  // IP address of the user performing the action
            $table->text('user_agent')->nullable();  // Information about user's browser/device (optional)
            $table->timestamp('created_at')->useCurrent();  // Timestamp of the action
            $table->json('action_data')->nullable();  // Optional: Store any additional JSON data (e.g., old values, new values)



            // Foreign key constraint (optional, assuming you have a 'users' table)
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audit_logs');
    }
};
