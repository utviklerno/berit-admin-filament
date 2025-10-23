<?php

namespace App\Filament\Pages;

use App\Models\PaymentSetting;
use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Form;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Support\Exceptions\Halt;
use Illuminate\Support\Facades\Gate;
use BackedEnum;

class PaymentSettings extends Page implements HasSchemas
{
    use InteractsWithSchemas;
    protected static string|BackedEnum|null $navigationIcon = "icon-chat-text";

    protected string $view = "filament.pages.payment-settings";

    public ?array $data = [];

    public static function getNavigationIcon(): ?string
    {
        return null;
    }

    public static function getNavigationGroup(): ?string
    {
        return "Settings";
    }

    public static function getNavigationLabel(): string
    {
        return "Payment Settings";
    }

    public static function getNavigationSort(): ?int
    {
        return 100;
    }

    public function mount(): void
    {
        abort_unless(Gate::allows("manage_settings"), 403);

        $settings = PaymentSetting::singleton();
        $this->data = $settings->toArray();
    }

    public function content(Schema $schema): Schema
    {
        return $schema->schema([
            Form::make([
                Section::make("General")->schema([
                    Select::make("default_gateway")
                        ->label("Default Payment Gateway")
                        ->options([
                            "stripe" => "Stripe",
                            "vipps" => "Vipps",
                        ])
                        ->placeholder("Select default gateway")
                        ->helperText(
                            "The preferred gateway when both are available. If only one is enabled, it will be used regardless of this setting.",
                        ),
                ]),

                Section::make("Stripe Configuration")
                    ->schema([
                        Toggle::make("stripe_enabled")
                            ->label("Enable Stripe")
                            ->live(),

                        Toggle::make("stripe_use_test_mode")
                            ->label("Use Test Mode")
                            ->helperText("Toggle between test and live keys")
                            ->live(),
                    ])
                    ->collapsible()
                    ->description("Configure Stripe payment gateway settings."),

                Section::make("Stripe Test Keys")
                    ->schema([
                        TextInput::make("stripe_test_publishable_key")
                            ->label("Test Publishable Key")
                            ->placeholder("pk_test_...")
                            ->maxLength(255),

                        TextInput::make("stripe_test_secret_key")
                            ->label("Test Secret Key")
                            ->placeholder("sk_test_...")
                            ->password()
                            ->revealable(),

                        TextInput::make("stripe_test_webhook_secret")
                            ->label("Test Webhook Secret")
                            ->placeholder("whsec_...")
                            ->password()
                            ->revealable()
                            ->helperText(
                                "Optional but recommended for webhook security",
                            ),
                    ])
                    ->collapsible()
                    ->collapsed()
                    ->description("Test keys for development and testing."),

                Section::make("Stripe Live Keys")
                    ->schema([
                        TextInput::make("stripe_live_publishable_key")
                            ->label("Live Publishable Key")
                            ->placeholder("pk_live_...")
                            ->maxLength(255),

                        TextInput::make("stripe_live_secret_key")
                            ->label("Live Secret Key")
                            ->placeholder("sk_live_...")
                            ->password()
                            ->revealable(),

                        TextInput::make("stripe_live_webhook_secret")
                            ->label("Live Webhook Secret")
                            ->placeholder("whsec_...")
                            ->password()
                            ->revealable()
                            ->helperText(
                                "Optional but recommended for webhook security",
                            ),
                    ])
                    ->collapsible()
                    ->collapsed()
                    ->description(
                        "⚠️ Live keys for production use only. Secrets are encrypted at rest.",
                    ),

                Section::make("Vipps Configuration")
                    ->schema([
                        Toggle::make("vipps_enabled")
                            ->label("Enable Vipps")
                            ->live(),

                        Toggle::make("vipps_use_sandbox")
                            ->label("Use Sandbox")
                            ->helperText(
                                "Toggle between test and live credentials",
                            )
                            ->live(),

                        TextInput::make("vipps_callback_prefix")
                            ->label("Callback URL Prefix")
                            ->placeholder(
                                "https://your-domain.tld/payments/vipps",
                            )
                            ->maxLength(2048)
                            ->url()
                            ->helperText(
                                "Base URL for Vipps payment callbacks",
                            ),
                    ])
                    ->collapsible()
                    ->description("Configure Vipps mobile payment settings."),

                Section::make("Vipps Test Credentials")
                    ->schema([
                        TextInput::make("vipps_test_merchant_serial_number")
                            ->label("Test Merchant Serial Number")
                            ->maxLength(255),

                        TextInput::make("vipps_test_client_id")
                            ->label("Test Client ID")
                            ->maxLength(255),

                        TextInput::make("vipps_test_client_secret")
                            ->label("Test Client Secret")
                            ->password()
                            ->revealable(),

                        TextInput::make("vipps_test_subscription_key")
                            ->label("Test Subscription Key")
                            ->password()
                            ->revealable(),
                    ])
                    ->collapsible()
                    ->collapsed()
                    ->description(
                        "Test credentials for Vipps sandbox environment.",
                    ),

                Section::make("Vipps Live Credentials")
                    ->schema([
                        TextInput::make("vipps_live_merchant_serial_number")
                            ->label("Live Merchant Serial Number")
                            ->maxLength(255),

                        TextInput::make("vipps_live_client_id")
                            ->label("Live Client ID")
                            ->maxLength(255),

                        TextInput::make("vipps_live_client_secret")
                            ->label("Live Client Secret")
                            ->password()
                            ->revealable(),

                        TextInput::make("vipps_live_subscription_key")
                            ->label("Live Subscription Key")
                            ->password()
                            ->revealable(),
                    ])
                    ->collapsible()
                    ->collapsed()
                    ->description(
                        "⚠️ Live credentials for production use only. Secrets are encrypted at rest.",
                    ),
            ])
                ->statePath("data")
                ->livewireSubmitHandler("save"),
        ]);
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make("save")
                ->label("Save Settings")
                ->color("primary")
                ->action("save"),
        ];
    }

    public function save(): void
    {
        try {
            // Custom validation
            $this->validateGatewaySettings($this->data);

            $settings = PaymentSetting::singleton();
            $settings->update($this->data);

            Notification::make()
                ->title("Payment settings saved successfully")
                ->success()
                ->send();
        } catch (Halt $exception) {
            return;
        }
    }

    protected function validateGatewaySettings(array $data): void
    {
        // Validate default gateway is enabled
        if (!empty($data["default_gateway"])) {
            $gatewayEnabled =
                $data[$data["default_gateway"] . "_enabled"] ?? false;
            if (!$gatewayEnabled) {
                $this->addError(
                    "default_gateway",
                    "The selected default gateway must be enabled.",
                );
                throw new Halt();
            }
        }

        // Validate Stripe required fields
        if ($data["stripe_enabled"] ?? false) {
            $useTestMode = $data["stripe_use_test_mode"] ?? false;

            if ($useTestMode) {
                if (empty($data["stripe_test_publishable_key"])) {
                    $this->addError(
                        "stripe_test_publishable_key",
                        "Test publishable key is required when Stripe is enabled in test mode.",
                    );
                    throw new Halt();
                }
                if (empty($data["stripe_test_secret_key"])) {
                    $this->addError(
                        "stripe_test_secret_key",
                        "Test secret key is required when Stripe is enabled in test mode.",
                    );
                    throw new Halt();
                }
            } else {
                if (empty($data["stripe_live_publishable_key"])) {
                    $this->addError(
                        "stripe_live_publishable_key",
                        "Live publishable key is required when Stripe is enabled in live mode.",
                    );
                    throw new Halt();
                }
                if (empty($data["stripe_live_secret_key"])) {
                    $this->addError(
                        "stripe_live_secret_key",
                        "Live secret key is required when Stripe is enabled in live mode.",
                    );
                    throw new Halt();
                }
            }
        }

        // Validate Vipps required fields
        if ($data["vipps_enabled"] ?? false) {
            $useSandbox = $data["vipps_use_sandbox"] ?? false;

            if ($useSandbox) {
                $requiredVippsFields = [
                    "vipps_test_merchant_serial_number" =>
                        "Test Merchant Serial Number",
                    "vipps_test_client_id" => "Test Client ID",
                    "vipps_test_client_secret" => "Test Client Secret",
                    "vipps_test_subscription_key" => "Test Subscription Key",
                ];
            } else {
                $requiredVippsFields = [
                    "vipps_live_merchant_serial_number" =>
                        "Live Merchant Serial Number",
                    "vipps_live_client_id" => "Live Client ID",
                    "vipps_live_client_secret" => "Live Client Secret",
                    "vipps_live_subscription_key" => "Live Subscription Key",
                ];
            }

            foreach ($requiredVippsFields as $field => $label) {
                if (empty($data[$field])) {
                    $this->addError(
                        $field,
                        "{$label} is required when Vipps is enabled.",
                    );
                    throw new Halt();
                }
            }
        }
    }

    public static function canAccess(): bool
    {
        return Gate::allows("manage_settings");
    }
}
