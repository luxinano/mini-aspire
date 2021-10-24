<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class UserResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'=> $this->user_id,
            'name'=> $this->name,
            'email'=> $this->email,
            'approver'=> $this->when(Auth::user()->approver, $this->approver),
        ];
    }
}
