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
        Schema::create('cargo_items', function (Blueprint $table) {
    $table->id();
    $table->foreignId('consignment_id')->constrained()->onDelete('cascade');
    $table->string('description');
    $table->integer('quantity');
    $table->decimal('price', 8, 2);
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cargo_items');
    }
};
