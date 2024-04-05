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
        Schema::create('show', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longtext('description')->nullable();
            $table->decimal('price', 8, 2);
            $table->foreignId('theater_id')->constrained('theaters');
            $table->foreignId('theme_id')->constrained('theme');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('show');
    }
};
