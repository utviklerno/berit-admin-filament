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
        Schema::create('payment_settings', function (Blueprint $table) {
            $table->id();
            
            // General settings
            $table->enum('default_gateway', ['stripe', 'vipps'])->nullable();
            
            // Stripe settings
            $table->boolean('stripe_enabled')->default(false);
            $table->boolean('stripe_use_test_mode')->default(true);
            $table->string('stripe_publishable_key')->nullable();
            $table->text('stripe_secret_key')->nullable();
            $table->text('stripe_webhook_secret')->nullable();
            
            // Vipps settings
            $table->boolean('vipps_enabled')->default(false);
            $table->boolean('vipps_use_sandbox')->default(true);
            $table->string('vipps_merchant_serial_number')->nullable();
            $table->string('vipps_client_id')->nullable();
            $table->text('vipps_client_secret')->nullable();
            $table->text('vipps_subscription_key')->nullable();
            $table->string('vipps_callback_prefix', 2048)->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_settings');
    }
};
