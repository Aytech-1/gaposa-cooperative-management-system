<?php

namespace App\Jobs;

use App\Models\Admin\Staff;
use App\Models\Setup\SetupCounter;
use Spatie\Permission\Models\Role;
use App\Services\LogActivitiesService;
use App\Services\Cache\ClearCacheService;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class StaffRegistrationJob implements ShouldQueue
{
    use Queueable;

    public function __construct(
        protected string $staffId,
        protected array $data,

    ) {}

    public function handle(): void
    { 
        $staffId = SetupCounter::generateCustomId('STAFF');
       
        $staff = Staff::create([
            'staff_id'       => $staffId,
            'title_id'       => $this->data['titleId'],
            'first_name'     => strtoupper($this->data['firstName']),
            'middle_name'    => strtoupper($this->data['middleName'] ?? null),
            'last_name'      => strtoupper($this->data['lastName']),
            'gender_id'      => $this->data['genderId'],
            'email'          => strtolower($this->data['emailAddress']),
            'mobile_number'  => $this->data['mobileNumber'],
            'home_address'   => strtoupper($this->data['homeAddress']),
            'password'      => $staffId,
            'created_by'     => $staffId,
        ]);

        $role = Role::findById($this->data['roleId'], 'admin');
        $staff->assignRole($role);

        LogActivitiesService::log('STAFF REGISTRATION COMPLETED',
        'The administrator successfully completed the registration process, resulting in the creation of a new account within the system with STAFFID: '. $staffId,
        $staffId);
        ClearCacheService::clearListCache('staff_list');
    }
}
