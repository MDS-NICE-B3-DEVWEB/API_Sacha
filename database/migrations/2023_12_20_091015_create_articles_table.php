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
            Schema::create('articles', function (Blueprint $table) {
                $table->integer('note');
                $table->longtext('commentaire')->nullable();
                $table->integer('user_id');
                $table->integer('theatre_id');
                $table->primary(['user_id', 'theatre_id']);
                $table->timestamps();
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
