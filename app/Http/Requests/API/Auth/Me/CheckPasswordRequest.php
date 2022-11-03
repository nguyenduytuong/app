<?php

namespace App\Http\Requests\API\Auth\Me;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class CheckPasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    #[ArrayShape(['password' => "string"])]
    public function rules(): array
    {
      if (isset(auth()->user()->provider_id) && auth()->user()->provider_id !== NULL) { // validate request for social id user
        return [];
      } else { // validate request for normal user
        return [
          'password' => 'required'
        ];
      }
    }
}
