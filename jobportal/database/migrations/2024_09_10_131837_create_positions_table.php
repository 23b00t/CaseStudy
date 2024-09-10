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
        Schema::create('positions', function (Blueprint $table) {
            $table->id();
            $table->string('title', length: 255);
            $table->text('description');
            $table->string('location', length: 256);
            $table->integer('salary');
            // create foreign key constraineds by naming convention
            // Delete a job if the company was deleted
            $table->foreignId('company_id')->constrained()->onDelete('cascade');
            // Set category to null if it was deleted
            $table->foreignId('category_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('user_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('positions');
    }
};
