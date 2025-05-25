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
        Schema::create('Lends', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('copy_id')->constrained('books')->onDelete('cascade');
            $table->foreignId('incident_id')->constrained('books')->onDelete('cascade');
            $table->date('lend_date');
            $table->date('real_return_date')->nullable();
            $table->date('expected_return_date')->nullable;
            $table->enum('status', ['pending', 'returned', 'overdue','renewed'])->default('pending');
            $table->string('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Lends');
    }
};
