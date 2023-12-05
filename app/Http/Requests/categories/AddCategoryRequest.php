<?php

namespace App\Http\Requests\categories;

use App\Services\Payments\Banks;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\File;
use Illuminate\Validation\Rules\Enum;

/** @property string bank */
/** @property File file */
class AddCategoryRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'parent_id' => ['nullable', 'int', 'exists:categories,id'],
            'name' => ['required', 'string'],
            'color' => ['required', 'string'],
        ];
    }
}
