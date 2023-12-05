<?php

namespace App\Http\Requests\files;

use App\Services\Payments\Banks;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\File;
use Illuminate\Validation\Rules\Enum;

/** @property string bank */
/** @property File file */
class AddPaymentsFileRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'bank' => ['required', 'string', new Enum(Banks::class)],
            'file' => ['required', 'file'],
        ];
    }
}
