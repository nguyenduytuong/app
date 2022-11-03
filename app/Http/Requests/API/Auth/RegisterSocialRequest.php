<?php

namespace App\Http\Requests\API\Auth;

use App\Enums\GenderEnum;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;
use Spatie\Enum\Laravel\Rules\EnumRule;


class RegisterSocialRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'first_name' => [
                'required',
                'string',
                'regex:/[\w\[\]`!@#$%\^&*()={}:;<>+"\'-?]*/',
                'between:1,50',
            ],
            'last_name' => [
                'required',
                'string',
                'regex:/[\w\[\]`!@#$%\^&*()={}:;<>+"\'-?]*/',
                'between:1,50',
            ],
            'gender' => [
                'nullable',
                new EnumRule(GenderEnum::class)
            ],
            'birth_date' => [
                'nullable',
                'date_format:' . User::BIRTH_DATE_FORMAT,
                'after_or_equal:' . User::MINIMUM_BIRTH_DATE,
            ],
            // 'email' => [
            //     'nullable'
            // ],
            'country_id' => [
                'required',
                'exists:countries,id',
            ],
            'phone' => [
                'nullable',
                'string',
                'max:20',
            ],
            'phone_code' => [
                'nullable',
                'string',
                // 'between:3,5',
            ],
            'provider_name' => [
                'required'
            ],
            'access_token' => [
                'required',
            ],
            'access_token_secret' => [
                'required_if:provider_name,twitter'
            ],
            'sport_ids' => [
                ['required', 'exists:sports,id'],
            ]
        ];

        if($this->phone){
            $rules['phone_code'] = array_merge(['required'], $rules['phone_code'] );
        }
        if($this->phone_code){
            $rules['phone'] = array_merge(['required'], $rules['phone'] );

        }

        return $rules;
    }

}
