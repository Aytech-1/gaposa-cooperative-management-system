<?php

namespace App\Jobs;


use App\Models\User\User;
use App\Services\LogActivitiesService;
use App\Services\Cache\ClearCacheService;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserRegistrationJob implements ShouldQueue
{
    use Queueable;

    // Create a new job instance.
    public function __construct(
        protected string $userId,
        protected array $data,
        protected string $adminId
    ){}
 
    // Execute the job.
    public function handle(): void
    {
        // Create user
        User::create([
            'user_id'       => $this->userId,
            'title_id'       => $this->data['titleId'],
            'first_name'     => $this->data['firstName'],
            'middle_name'    => $this->data['middleName'] ?? null,
            'last_name'      => $this->data['lastName'],
            'gender_id'      => $this->data['genderId'],
            'email'          => $this->data['emailAddress'],
            'mobile_number'  => $this->data['mobileNumber'],
            'home_address'   => $this->data['homeAddress'],
            'password'      => $this->userId,
            'created_by'     => $this->adminId,
        ]);

        ClearCacheService::clearListCache('user_list');
        LogActivitiesService::log('USER_REGISTRATION_COMPLETED',
        'The administrator successfully completed the registration process, resulting in the creation of a new account within the system with USERID: '. $this->userId,
        $this->adminId);
       
    }
}
