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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->string('car_id');
            $table->string('status')->nullable()->default('pending');
            // Rental details
            $table->string('pickup_date');
            $table->string('pickup_time');
            $table->string('dropoff_date');
            $table->string('dropoff_time');
            $table->decimal('grand_total', 10, 2);

            // Personal details
            $table->string('full_name');
            $table->string('email');
            $table->string('phone');
            $table->string('whatsapp')->nullable();
            $table->date('date_of_birth');
            $table->string('nationality');
            $table->string('delivery_location');
            $table->string('receiving_location');
            $table->boolean('has_international_license')->default(false);
            $table->text('special_request')->nullable();

            // Credit card details (store encrypted or tokenized if required)
            // $table->string('card_holder_name');
            // $table->string('card_number');
            // $table->string('expiry_date');
            // $table->string('security_code');

            // Billing address
            $table->string('billing_country')->nullable();
            $table->string('billing_state')->nullable();
            $table->string('billing_city')->nullable();
            $table->string('billing_zip')->nullable();
            $table->text('billing_address')->nullable();
            $table->json('license_files')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
