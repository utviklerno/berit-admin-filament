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
        Schema::table('payment_settings', function (Blueprint $table) {
            // Add separate Stripe test and production keys
            $table->string('stripe_test_publishable_key')->nullable()->after('stripe_use_test_mode');
            $table->text('stripe_test_secret_key')->nullable()->after('stripe_test_publishable_key');
            $table->text('stripe_test_webhook_secret')->nullable()->after('stripe_test_secret_key');
            
            $table->string('stripe_live_publishable_key')->nullable()->after('stripe_test_webhook_secret');
            $table->text('stripe_live_secret_key')->nullable()->after('stripe_live_publishable_key');
            $table->text('stripe_live_webhook_secret')->nullable()->after('stripe_live_secret_key');
            
            // Add separate Vipps sandbox and production keys
            $table->string('vipps_test_merchant_serial_number')->nullable()->after('vipps_use_sandbox');
            $table->string('vipps_test_client_id')->nullable()->after('vipps_test_merchant_serial_number');
            $table->text('vipps_test_client_secret')->nullable()->after('vipps_test_client_id');
            $table->text('vipps_test_subscription_key')->nullable()->after('vipps_test_client_secret');
            
            $table->string('vipps_live_merchant_serial_number')->nullable()->after('vipps_test_subscription_key');
            $table->string('vipps_live_client_id')->nullable()->after('vipps_live_merchant_serial_number');
            $table->text('vipps_live_client_secret')->nullable()->after('vipps_live_client_id');
            $table->text('vipps_live_subscription_key')->nullable()->after('vipps_live_client_secret');
            
            // Remove old single key columns
            $table->dropColumn([
                'stripe_publishable_key',
                'stripe_secret_key', 
                'stripe_webhook_secret',
                'vipps_merchant_serial_number',
                'vipps_client_id',
                'vipps_client_secret',
                'vipps_subscription_key'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payment_settings', function (Blueprint $table) {
            // Add back the old single key columns
            $table->string('stripe_publishable_key')->nullable();
            $table->text('stripe_secret_key')->nullable();
            $table->text('stripe_webhook_secret')->nullable();
            $table->string('vipps_merchant_serial_number')->nullable();
            $table->string('vipps_client_id')->nullable();
            $table->text('vipps_client_secret')->nullable();
            $table->text('vipps_subscription_key')->nullable();
            
            // Remove the separate test/production columns
            $table->dropColumn([
                'stripe_test_publishable_key',
                'stripe_test_secret_key',
                'stripe_test_webhook_secret',
                'stripe_live_publishable_key',
                'stripe_live_secret_key',
                'stripe_live_webhook_secret',
                'vipps_test_merchant_serial_number',
                'vipps_test_client_id',
                'vipps_test_client_secret',
                'vipps_test_subscription_key',
                'vipps_live_merchant_serial_number',
                'vipps_live_client_id',
                'vipps_live_client_secret',
                'vipps_live_subscription_key'
            ]);
        });
    }
};
