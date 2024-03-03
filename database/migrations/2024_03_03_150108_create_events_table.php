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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->string('images');
            $table->text('description');
            $table->timestamp('date');
            $table->enum('status', ['valide', 'invalide'])->default('invalide');
            $table->enum('typeAccept', ['automatique', 'manuelle']);
            $table->string('location');
            $table->foreignId('category_id')->constrained('events')->onDelete('cascade');
            $table->integer('places');
            $table->timestamps();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
