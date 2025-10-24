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
        Schema::create('achievements', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('type'); // award, certificate, achievement
            $table->string('issuer')->nullable(); // Organization that issued it
            $table->text('description')->nullable();
            $table->date('date')->nullable();
            $table->string('icon')->nullable(); // Icon name or emoji
            $table->string('url')->nullable(); // Link to certificate or credential
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('achievements');
    }
};
