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
        Schema::create('consignments', function (Blueprint $table) {
    $table->id();
    $table->string('passport_no');
    $table->enum('shipping_mode', ['reguler', 'laut']);
    
    // Sender
    $table->string('sender_name');
    $table->string('sender_hotel')->nullable();
    $table->string('sender_city');
    $table->string('sender_country');
    $table->string('sender_phone');
    
    // Receiver
    $table->string('receiver_name');
    $table->string('receiver_address');
    $table->string('receiver_city');
    $table->string('receiver_province')->nullable();
    $table->string('receiver_postal_code')->nullable();
    $table->string('receiver_country');
    $table->string('receiver_contact')->nullable();
    $table->string('receiver_phone');

    // Summary
    $table->enum('carton_type', ['S', 'M', 'L']);
    $table->decimal('weight', 8, 2);
    $table->decimal('admin_fee', 8, 2);
    $table->decimal('total_cost', 10, 2);

    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consignments');
    }
};
