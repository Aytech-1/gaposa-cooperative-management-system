<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ActivitiesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            'action' => $this->action,
            'description' => $this->description,
            'userType' => $this->user_type,
            'deviceModel' => $this->device_model,
            'browserName' => $this->browser_name,
            'ipIddress' => $this->ip_address,
            'createdAt' => $this->created_at->toDateTimeString(),
            'performedBy' => $this->staff 
            ? [
                'staffId' => $this->staff->staff_id,
                'fullName' => $this->staff->first_name . ' ' . $this->staff->last_name,
            ] : ($this->user ? [
                'userId'=> $this->user->user_id,
                'fullName' => $this->user->first_name . ' ' . $this->user->last_name,
            ] : null),
        ];

    }
}
