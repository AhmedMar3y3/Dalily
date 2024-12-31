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
        Schema::create('places', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('map_disc')->nullable();
            $table->string('longitude');
            $table->string('latitude');
            $table->double('rating')->default(0);
            $table->enum('status', ['مفتوح', 'مغلق'])->default('مفتوح');
            $table->time('open_at')->default('10:00:00');
            $table->time('close_at')->default('03:00:00');
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('places');
    }
};
