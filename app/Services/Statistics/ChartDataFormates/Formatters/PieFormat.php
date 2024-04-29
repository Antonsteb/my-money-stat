<?php

namespace App\Services\Statistics\ChartDataFormates\Formatters;

use App\Models\Category;
use App\Models\statistics\DayStatistic;
use App\Services\Statistics\ChartDataFormates\ChartDataFormat;
use App\Services\Statistics\ChartIntervals;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Database\Eloquent\Collection;

class PieFormat extends ChartDataFormat
{
    protected function updateChartLabels(): void
    {
        $this->labels = $this->categories->pluck('name')->all();
    }

    protected function updateChartData(): void
    {
        $categoryIds = $this->categories->pluck('id')->all();
        $statistics = DayStatistic::query()->whereIn('category_id', $categoryIds)->get()->groupBy('category_id');
        $data = $statistics->map(function ($group) {
            return abs($group->sum('amount_sum'));
        })->values();
        $backgroundColor = $this->categories->pluck('color')->all();
        $this->chartData = [
            [
                'backgroundColor' => $backgroundColor,
                'data' => $data
            ]
        ];
    }

}
