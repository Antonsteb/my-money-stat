<?php

namespace App\Services\Statistics\ChartDataFormates;

use App\Models\Category;
use App\Models\statistics\DayStatistic;
use App\Services\Statistics\ChartIntervals;
use App\Services\Statistics\ChartTypes;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Database\Eloquent\Collection;

abstract class ChartDataFormat
{
    protected array $labels = [];
    protected array $chartData = [];

    public function __construct(
        protected Carbon $startDate,
        protected Carbon $endDate,
        protected readonly ChartIntervals $chartIntervals,
        protected readonly Collection $categories,
    )
    {

    }

    public function setStartDate(Carbon $startDate): void
    {
        $this->startDate = $startDate;
    }
    public function setEndDate(Carbon $endDate): void
    {
        $this->endDate = $endDate;
    }

    public function getLabels(): array
    {
        return  $this->labels;
    }

    public function getChartData(): array
    {
        return $this->chartData;
    }

    public function updateData(): void
    {
        $this->updateChartLabels();
        $this->updateChartData();
    }

    abstract protected function updateChartLabels(): void;
    abstract protected function updateChartData(): void;
}
