<?php

namespace App\Services;

use App\Models\PaymentSetting;

class PaymentConfig
{
    private PaymentSetting $settings;

    public function __construct()
    {
        $this->settings = PaymentSetting::singleton();
    }

    public function getDefaultGateway(): ?string
    {
        return $this->settings->default_gateway;
    }

    public function getAvailableGateways(): array
    {
        $available = [];
        
        if ($this->settings->stripeUsable()) {
            $available[] = 'stripe';
        }
        
        if ($this->settings->vippsUsable()) {
            $available[] = 'vipps';
        }
        
        return $available;
    }

    public function getEffectiveGateway(): ?string
    {
        $available = $this->getAvailableGateways();
        
        if (empty($available)) {
            return null;
        }
        
        $default = $this->getDefaultGateway();
        
        // If default is set and available, use it
        if ($default && in_array($default, $available)) {
            return $default;
        }
        
        // Otherwise return the first available gateway
        return $available[0];
    }

    public function isStripeEnabled(): bool
    {
        return $this->settings->stripe_enabled;
    }

    public function isVippsEnabled(): bool
    {
        return $this->settings->vipps_enabled;
    }

    public function hasAnyGatewayEnabled(): bool
    {
        return !empty($this->getAvailableGateways());
    }

    public function getStripeConfig(): ?array
    {
        if (!$this->settings->stripeUsable()) {
            return null;
        }

        $keys = $this->settings->getStripeKeys();
        
        return [
            'publishable_key' => $keys['publishable_key'],
            'secret_key' => $keys['secret_key'],
            'webhook_secret' => $keys['webhook_secret'],
            'use_test_mode' => $this->settings->stripe_use_test_mode,
        ];
    }

    public function getVippsConfig(): ?array
    {
        if (!$this->settings->vippsUsable()) {
            return null;
        }

        $keys = $this->settings->getVippsKeys();
        
        return [
            'merchant_serial_number' => $keys['merchant_serial_number'],
            'client_id' => $keys['client_id'],
            'client_secret' => $keys['client_secret'],
            'subscription_key' => $keys['subscription_key'],
            'callback_prefix' => $this->settings->vipps_callback_prefix,
            'use_sandbox' => $this->settings->vipps_use_sandbox,
        ];
    }
}