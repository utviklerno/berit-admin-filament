<?php

namespace App\Observers;

use App\Models\ActivityLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ActivityLogObserver
{
    public function created(Model $model): void
    {
        $this->logActivity($model, 'created');
    }

    public function updated(Model $model): void
    {
        \Log::info('ActivityLogObserver: updated event fired', [
            'model' => get_class($model),
            'id' => $model->id,
            'wasChanged' => $model->wasChanged(),
            'changes' => $model->getChanges(),
        ]);
        
        $this->logActivity($model, 'updated');
    }

    public function deleted(Model $model): void
    {
        $this->logActivity($model, 'deleted');
    }

    protected function logActivity(Model $model, string $action): void
    {
        if ($model instanceof ActivityLog) {
            return;
        }

        $adminUser = Auth::guard('admin')->user();
        
        if (!$adminUser) {
            \Log::warning('ActivityLogObserver: No admin user authenticated', [
                'model' => get_class($model),
                'action' => $action,
                'guards' => array_keys(config('auth.guards')),
                'default_guard' => config('auth.defaults.guard'),
            ]);
            return;
        }

        $modelName = class_basename($model);
        $identifier = $this->getModelIdentifier($model);
        
        $description = match ($action) {
            'created' => "{$adminUser->name} created {$modelName} '{$identifier}'",
            'updated' => "{$adminUser->name} edited {$modelName} '{$identifier}'",
            'deleted' => "{$adminUser->name} deleted {$modelName} '{$identifier}'",
            default => "{$adminUser->name} performed {$action} on {$modelName} '{$identifier}'",
        };

        $properties = [];
        if ($action === 'updated' && method_exists($model, 'getDirty')) {
            $changes = $model->getDirty();
            if (!empty($changes)) {
                $properties['changed_fields'] = array_keys($changes);
            }
        }

        ActivityLog::create([
            'admin_user_id' => $adminUser->id,
            'subject_type' => get_class($model),
            'subject_id' => $model->id,
            'action' => $action,
            'description' => $description,
            'properties' => !empty($properties) ? $properties : null,
        ]);
    }

    protected function getModelIdentifier(Model $model): string
    {
        if (isset($model->name)) {
            return $model->name;
        }
        
        if (isset($model->title)) {
            return $model->title;
        }
        
        if (isset($model->pagename)) {
            return $model->pagename;
        }
        
        if (isset($model->email)) {
            return $model->email;
        }

        if (isset($model->filename)) {
            return $model->filename;
        }

        return "ID: {$model->id}";
    }
}
