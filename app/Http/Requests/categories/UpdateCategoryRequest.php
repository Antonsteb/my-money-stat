<?php

namespace App\Http\Requests\categories;

use App\Services\Payments\Banks;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\File;
use Illuminate\Validation\Rules\Enum;

/** @property int id */
class UpdateCategoryRequest extends AddCategoryRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {

        return [
            ...parent::rules(),
            'id' => ['required', 'int', 'exists:categories,id'],
        ];
    }
}
