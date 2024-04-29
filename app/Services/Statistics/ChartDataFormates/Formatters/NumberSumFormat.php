<?php

namespace App\Services\Statistics\ChartDataFormates\Formatters;


use App\Models\Category;
use App\Models\statistics\DayStatistic;
use App\Services\Statistics\ChartDataFormates\ChartDataFormat;
use Carbon\Carbon;

class NumberSumFormat extends ChartDataFormat
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
        $sum = $this->chartIntervals->getChartDataQueryBuilder($category)
            ->whereBetween('date', [$this->startDate, $this->endDate])->sum('amount_sum');

        $result += $sum;

        $this->chartData = [abs($result)];
    }
}
