<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'email' => $this->email,
            // 'first_name' => isset($this->first_name) ? app('profanityFilter')->replaceWith('*')->replaceFullWords(false)->filter($this->first_name) : null,
            // 'last_name' => isset($this->last_name) ? app('profanityFilter')->replaceWith('*')->replaceFullWords(false)->filter($this->last_name) : null,
            // 'full_name' => isset($this->name) ? app('profanityFilter')->replaceWith('*')->replaceFullWords(false)->filter($this->name) : null,
            // 'phone' => isset($this->phone) ? $this->phone : null,
            // 'gender' => isset($this->gender) ? $this->gender : null,
            // 'birth_date' => isset($this->birth_date) ? $this->birth_date : null,
            // 'bio' =>  isset($this->bio) ? app('profanityFilter')->replaceWith('*')->replaceFullWords(false)->filter($this->bio) : null,
            // 'avatar' => isset($this->avatar) ? $this->avatar : null,
            // 'background_image' => isset($this->background_image)
            //     ? $this->background_image
            //     : null,
            // 'country' => isset($this->country) ? $this->country : null,
            // 'sports' => isset($this->sports) ? $this->sports : null,
            // 'status' => isset($this->status) ? $this->status : null,
            // 'role' => isset($this->roles) ? $this->roles : null,
            // 'currency' => $this->currency,
            // 'media' => $this?->media?->toArray(),
        ];
    }
}
