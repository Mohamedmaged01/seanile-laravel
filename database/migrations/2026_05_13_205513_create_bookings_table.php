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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('booking_number')->unique();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('trip_id')->nullable()->constrained()->nullOnDelete();
            // Traveler info
            $table->string('full_name');
            $table->string('email');
            $table->string('phone');
            $table->string('nationality')->nullable();
            $table->string('hotel')->nullable();
            // Trip details
            $table->date('trip_date');
            $table->time('preferred_time')->nullable();
            $table->integer('adults')->default(1);
            $table->integer('children')->default(0);
            $table->integer('infants')->default(0);
            // Extras
            $table->boolean('vip_transfer')->default(false);
            $table->boolean('private_guide')->default(false);
            $table->boolean('diving_equip')->default(false);
            $table->boolean('photography')->default(false);
            $table->boolean('insurance')->default(false);
            $table->boolean('meals')->default(false);
            $table->text('special_requests')->nullable();
            // Payment
            $table->string('payment_method')->default('cash'); // card, bank, wallet, paypal, apple, cash
            $table->string('currency')->default('USD');
            $table->string('promo_code')->nullable();
            $table->decimal('subtotal', 10, 2)->default(0);
            $table->decimal('discount', 10, 2)->default(0);
            $table->decimal('tax', 10, 2)->default(0);
            $table->decimal('total', 10, 2)->default(0);
            // Status
            $table->string('status')->default('pending'); // pending, confirmed, completed, cancelled
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
