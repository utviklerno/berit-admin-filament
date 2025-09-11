<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class PaymentSetting extends Model
{
    protected $fillable = [
        'default_gateway',
        'stripe_enabled',
        'stripe_use_test_mode',
        'stripe_test_publishable_key',
        'stripe_test_secret_key',
        'stripe_test_webhook_secret',
        'stripe_live_publishable_key',
        'stripe_live_secret_key',
        'stripe_live_webhook_secret',
        'vipps_enabled',
        'vipps_use_sandbox',
        'vipps_test_merchant_serial_number',
        'vipps_test_client_id',
        'vipps_test_client_secret',
        'vipps_test_subscription_key',
        'vipps_live_merchant_serial_number',
        'vipps_live_client_id',
        'vipps_live_client_secret',
        'vipps_live_subscription_key',
        'vipps_callback_prefix',
    ];

    protected $casts = [
        'stripe_enabled' => 'boolean',
        'stripe_use_test_mode' => 'boolean',
        'stripe_test_secret_key' => 'encrypted',
        'stripe_test_webhook_secret' => 'encrypted',
        'stripe_live_secret_key' => 'encrypted',
        'stripe_live_webhook_secret' => 'encrypted',
        'vipps_enabled' => 'boolean',
        'vipps_use_sandbox' => 'boolean',
        'vipps_test_client_secret' => 'encrypted',
        'vipps_test_subscription_key' => 'encrypted',
        'vipps_live_client_secret' => 'encrypted',
        'vipps_live_subscription_key' => 'encrypted',
    ];

    protected static function booted()
    {
        static::saved(function () {
            Cache::forget('payment_settings_singleton');
        });

        static::deleted(function () {
            Cache::forget('payment_settings_singleton');
        });
    }

    public static function singleton(): self
    {
        return Cache::remember('payment_settings_singleton', 60, function () {
            return static::first() ?? static::create([
                'stripe_enabled' => false,
                'stripe_use_test_mode' => true,
                'vipps_enabled' => false,
                'vipps_use_sandbox' => true,
            ]);
        });
    }

    public function stripeUsable(): bool
    {
        if (!$this->stripe_enabled) {
            return false;
        }
        
        if ($this->stripe_use_test_mode) {
            return !empty($this->stripe_test_publishable_key) &&
                   !empty($this->stripe_test_secret_key);
        } else {
            return !empty($this->stripe_live_publishable_key) &&
                   !empty($this->stripe_live_secret_key);
        }
    }

    public function vippsUsable(): bool
    {
        if (!$this->vipps_enabled) {
            return false;
        }
        
        if ($this->vipps_use_sandbox) {
            return !empty($this->vipps_test_client_id) &&
                   !empty($this->vipps_test_client_secret) &&
                   !empty($this->vipps_test_subscription_key) &&
                   !empty($this->vipps_test_merchant_serial_number);
        } else {
            return !empty($this->vipps_live_client_id) &&
                   !empty($this->vipps_live_client_secret) &&
                   !empty($this->vipps_live_subscription_key) &&
                   !empty($this->vipps_live_merchant_serial_number);
        }
    }

    public function getStripeKeys(): array
    {
        if ($this->stripe_use_test_mode) {
            return [
                'publishable_key' => $this->stripe_test_publishable_key,
                'secret_key' => $this->stripe_test_secret_key,
                'webhook_secret' => $this->stripe_test_webhook_secret,
            ];
        } else {
            return [
                'publishable_key' => $this->stripe_live_publishable_key,
                'secret_key' => $this->stripe_live_secret_key,
                'webhook_secret' => $this->stripe_live_webhook_secret,
            ];
        }
    }

    public function getVippsKeys(): array
    {
        if ($this->vipps_use_sandbox) {
            return [
                'merchant_serial_number' => $this->vipps_test_merchant_serial_number,
                'client_id' => $this->vipps_test_client_id,
                'client_secret' => $this->vipps_test_client_secret,
                'subscription_key' => $this->vipps_test_subscription_key,
            ];
        } else {
            return [
                'merchant_serial_number' => $this->vipps_live_merchant_serial_number,
                'client_id' => $this->vipps_live_client_id,
                'client_secret' => $this->vipps_live_client_secret,
                'subscription_key' => $this->vipps_live_subscription_key,
            ];
        }
    }
}
