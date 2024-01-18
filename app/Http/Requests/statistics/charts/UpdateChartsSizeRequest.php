<?php

namespace App\Http\Requests\statistics\charts;

use App\Services\Payments\Banks;
use App\Services\Statistics\ChartIntervals;
use App\Services\Statistics\ChartTypes;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\File;
use Illuminate\Validation\Rules\Enum;

/**
 * @property int $category_id
 * @property int payment_id
 */
class UpdateChartsSizeRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'w' => ['required', 'int'],
            'h' => ['required', 'int'],
        ];
    }
}
