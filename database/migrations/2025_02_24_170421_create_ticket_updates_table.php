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
        Schema::create('ticket_updates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ticket_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->text('message');
            $table->string('status');
            $table->string('priority');
            $table->string('type');
            $table->string('attachment')->nullable();
            $table->string('assigned_to')->nullable();
            $table->string('resolved_by')->nullable();
            $table->string('closed_by')->nullable();
            $table->string('reopened_by')->nullable();
            $table->string('reopened')->nullable();
            $table->string('resolved')->nullable();
            $table->string('closed')->nullable();
            $table->string('reopened_at')->nullable();
            $table->string('resolved_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ticket_updates');
    }
};
