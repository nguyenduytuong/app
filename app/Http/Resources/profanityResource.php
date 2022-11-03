<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use ConsoleTVs\Profanity\Facades\Profanity;

class profanityResource extends JsonResource
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
            'name' => app('profanityFilter')->replaceWith('*')->replaceFullWords(false)->filter($this->name),
            
        ];
    }
}
