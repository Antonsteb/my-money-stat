<?php

namespace App\Services\Statistics\ChartDataFormates\Formatters;


use App\Models\Category;
use App\Models\statistics\DayStatistic;
use App\Services\Statistics\ChartDataFormates\ChartDataFormat;
use Carbon\Carbon;

class NumberAvgFormat extends ChartDataFormat
{
    protected function updateChartLabels(): void
    {
        $this->labels = [$this->categories->first()->name];
    }

    protected function updateChartData(): void
    {
        $result = 0;
        /** @var Category $category */
        $category = $this->categories->first();
        $query = $this->chartIntervals->getChartDataQueryBuilder($category)
            ->whereBetween('date', [$this->startDate, $this->endDate]);
        if ($count = $query->count()) {
            $result = abs($query->sum('amount_sum') / $count);
        }

        $this->chartData = [$result];
    }
}
