<?php

namespace App\Http\Requests\auth;


use App\Services\Social\AccountCreateType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

/**
 * @property string social
 */
class SocialAccountRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {


        return [
            'social' => ['required', 'string', new Enum(AccountCreateType::class)],
        ];
    }

    public function messages(): array
    {
        return [
            "social" => "Неизвестный провайдер авторизации.",
        ];
    }


}
