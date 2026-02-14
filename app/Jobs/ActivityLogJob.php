<?php

namespace App\Jobs;

use App\Services\ActivityLogService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ActivityLogJob implements ShouldQueue
{
    use Queueable;

    public function __construct(
        protected string $action,
        protected string $description,
        protected string $userType,
        protected string $performedBy,
        protected ?int $roleId,
        protected array $metadata = []
    )
    {}

    public function handle(): void
    {
        ActivityLogService::log(
            action: $this->action,
            description: $this->description,
            userType: $this->userType,
            performedBy: $this->performedBy,
            roleId: $this->roleId,
            metadata: $this->metadata
        );
    }
}
