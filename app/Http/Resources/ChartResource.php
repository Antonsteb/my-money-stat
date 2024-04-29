<?php

namespace App\Http\Resources;

use App\Models\Chart;
use App\Services\Statistics\ChartDataFormates\Formatters\LineFormat;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChartResource extends JsonResource
{
    public static $wrap = null;
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var $this Chart */
        $startDate = \Carbon\Carbon::parse('2023-10-06 00:00:00');
        $endDate = \Carbon\Carbon::parse('2023-10-20 13:42:13');

//        $intervalEntity = $this->interval->getIntervalEntity($startDate, $endDate);
//        $chartEntity = $this->type->getChartDataEntity($intervalEntity);
        $chartFormatter = $this->type->getDataFormatter($startDate, $endDate, $this->interval, $this->categories);
        $chartFormatter->updateData();
        return [
            'type' => $this->type,
            'x' => $this->x,
            'y' => $this->y,
            'w' => $this->w,
            'h' => $this->h,
            'i' => $this->id,
            'chartLabels' => $chartFormatter->getLabels(),
            'chartData' => $chartFormatter->getChartData(),
//            'chartLabels' => $chartEntity->getLabels(),
//            'chartData' => $chartEntity->getChartData($this->categories),
        ];
    }
}
