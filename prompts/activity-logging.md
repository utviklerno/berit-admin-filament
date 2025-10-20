# Activity Logging Instructions

This document explains how to add automatic activity logging to models in the Berit Admin application.

## Overview

The activity logging system automatically tracks when admin users create, update, or delete records in the admin panel. Logs are displayed in the **Settings → Logs** section.

## How It Works

The system uses Laravel Model Observers to automatically log actions. When a model is created, updated, or deleted, the observer captures:
- The admin user who performed the action
- The action type (created, updated, deleted)
- The model type and ID
- A human-readable description
- Additional metadata (e.g., which fields were changed)

## Adding Activity Logging to a New Model

To enable activity logging for a new model, follow these steps:

### 1. Register the Observer

Open `app/Providers/AppServiceProvider.php` and add your model to the `boot()` method:

```php
use App\Models\YourModel;
use App\Observers\ActivityLogObserver;

public function boot(): void
{
    // Existing observers
    Page::observe(ActivityLogObserver::class);
    Menu::observe(ActivityLogObserver::class);
    User::observe(ActivityLogObserver::class);
    
    // Add your new model
    YourModel::observe(ActivityLogObserver::class);
    
    // ... rest of boot method
}
```

### 2. Add Import Statement

Make sure to import your model at the top of `AppServiceProvider.php`:

```php
use App\Models\YourModel;
```

### 3. Customize Model Identifier (Optional)

The observer automatically tries to identify records using these fields (in order):
- `name`
- `title`
- `pagename`
- `email`
- `filename`
- Falls back to `ID: {id}`

If your model uses a different field for its primary identifier, you can update the `getModelIdentifier()` method in `app/Observers/ActivityLogObserver.php`:

```php
protected function getModelIdentifier(Model $model): string
{
    // Add your custom field
    if (isset($model->your_custom_field)) {
        return $model->your_custom_field;
    }
    
    // ... existing checks
}
```

## Currently Logged Models

The following models are currently configured for activity logging:
- `Page` - Pages
- `Subpage` - Subpages (page translations/versions)
- `Menu` - Menus
- `MenuItem` - Menu items
- `User` - End users
- `Folder` - Media folders
- `File` - Media files
- `ProductType` - Product types
- `ProductTypeItem` - Product type items

## Log Entry Format

Logs are formatted as: `"{Admin Name} {action} {Model Type} '{Identifier}'"`

Examples:
- "Tom-Erik created Page 'Subscription'"
- "Tom-Erik edited Menu 'Main Menu'"
- "Tom-Erik deleted User 'john@example.com'"

## Viewing Logs

Logs can be viewed in the admin panel:
1. Navigate to **Settings → Logs**
2. Filter by action type or model type
3. Search by admin name or description
4. Click on a log entry to view detailed information

## Technical Details

### Database Schema

The `activity_logs` table contains:
- `id` - Primary key
- `admin_user_id` - Foreign key to admin_users
- `subject_type` - Model class name (polymorphic)
- `subject_id` - Model ID (polymorphic)
- `action` - Action type (created, updated, deleted)
- `description` - Human-readable description
- `properties` - JSON field for additional metadata
- `created_at` / `updated_at` - Timestamps

### Observer Location

The observer is located at `app/Observers/ActivityLogObserver.php` and handles:
- `created()` - Logs when a record is created
- `updated()` - Logs when a record is updated (includes changed fields)
- `deleted()` - Logs when a record is deleted

### Authentication Guard

The observer only logs actions performed by authenticated admin users via the `admin` guard. Actions performed programmatically (e.g., in seeders, console commands, or API requests) are not logged.

## Important Notes

- Logs are **read-only** in the admin panel - they cannot be edited or created manually
- Logs can be bulk-deleted if needed
- The observer automatically skips logging if no admin user is authenticated
- For updated records, the system tracks which fields were changed and stores them in the `properties` column
