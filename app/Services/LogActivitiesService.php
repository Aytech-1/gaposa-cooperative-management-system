<?php

namespace App\Services;

use App\Models\Setup\SetupLogActivity;
use Jenssegers\Agent\Agent;

class LogActivitiesService
{
    public static function log(
        string $action,
        string $description,
        string $performedBy,
        string $userType = 'admin',
    ): void {
        $agent = new Agent();
        SetupLogActivity::create([
            'action'        => $action,
            'description'   => $description,
            'performed_by'  => $performedBy,
            'user_type'     => $userType,
            'ip_address'    => request()->ip(),
            'device_model'  => $agent->device() ?: 'Unknown Device',
            'browser_name'  => $agent->browser() ?: 'Unknown Browser',
        ]);
    }
}
