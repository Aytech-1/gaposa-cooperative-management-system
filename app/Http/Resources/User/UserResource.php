<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'userId' => $this->user_id,
            'firstName' => $this->first_name,
            'middleName' => $this->middle_name,
            'lastName' => $this->last_name,
            'emailAddress' => $this->email,
            'phoneNumber' => $this->mobile_number,
            'homeAddress' => $this->home_address,
            'lastLoginAt' => $this->last_login_at,
            'gender' => [
                'genderId' => $this->gender_id,
                'genderName' => $this->gender?->gender_name
            ],
            'title' => [
                'titleId' => $this->title_id,
                'titleName' => $this->title?->title_name

            ],
             'status' => [
                'statusId' => $this->status_id,
                'statusName' => $this->status?->status_name
            ],

            'passport' => [
                'passportUrl' => $this->passport ? Storage::url("passports/userPictures/{$this->passport}") : null
            ],
        ];

    }
}
