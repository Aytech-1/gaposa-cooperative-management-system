<?php

namespace App\Services;

// use App\Services\Config;
use App\Models\Admin\ActivityLog;
use Illuminate\Support\Facades\Config;

class ActivityLogService
{
    public static function log(
        string $action,
        string $description,
        string $userType,
        string $performedBy,
        int $roleId,
        array $metadata
    ): void {
        $details = Config::requestDetails();
        ActivityLog::create([
            'performed_by' => $performedBy,
            'role_id' => $roleId,
            'user_type'    => $userType,
            'action'       => $action,
            'description'  => $description,
            'metadata'     => $metadata,
            'ip_address' => request()->ip(),
            'device' => $details['device'],
            'browser' => $details['browser'],
            'created_at'   => now(),
        ]);
    }
}