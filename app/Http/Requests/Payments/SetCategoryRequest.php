<?php

namespace App\Http\Requests\Payments;

use App\Services\Payments\Banks;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\File;
use Illuminate\Validation\Rules\Enum;

/**
 * @property int $category_id
 * @property int payment_id
 */
class SetCategoryRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'category_id' => ['required', 'int', 'exists:categories,id'],
            'payment_id' => ['required', 'int', 'exists:bank_payments,id'],
        ];
    }
}
