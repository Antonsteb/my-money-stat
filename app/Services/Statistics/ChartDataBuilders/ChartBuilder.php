<?php

namespace App\Services\Statistics\ChartDataBuilders;

use App\Models\Category;
use App\Models\statistics\DayStatistic;
use App\Services\Statistics\ChartIntervals;
use App\Services\Statistics\ChartTypes;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Database\Eloquent\Collection;

class ChartBuilder
{
    private array $labels = [];
    private array $chartData = [];

    public function __construct(
        private readonly Carbon $startDate,
        private readonly Carbon $endDate,
        private readonly ChartTypes $chartType,
        private readonly ChartIntervals $chartIntervals,
        private readonly Collection $categories,
    )
    {

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
        $this->generateChartLabels();
        $this->generateChartData();
    }

    private function generateNumberLabels(): void
    {
    }
    private function generateNumberData(): void
    {
    }
    private function generateChartLabels(): void
    {
        $period = new CarbonPeriod($this->startDate, $this->chartIntervals->getIntervalString(),$this->endDate);
//        $dates = $period->map(function (Carbon $date) use ($format) {
//            return $date->format($format);
//        });
        $dates = [];
        foreach ($period as $date) {
            $dates[]= $date->format($this->chartIntervals->getIntervalDateFormat());
        }
        $this->labels = $dates;
    }
    private function generateChartData(): void
    {
        $result = [];
        /** @var Category $category */
        foreach ($this->categories as $category) {
            // даты по которым нет данных должны быть null
            $data = array_fill(0, count($this->labels), null);
            $dayStatistics = $this->chartIntervals->getChartDataQueryBuilder($category)
                ->whereBetween('date', [$this->startDate, $this->endDate])->orderBy('date')->get();

            // заполняем даты по которым есть данные
            $i = 0;
            /** @var DayStatistic $dayStatistic */
            foreach ($dayStatistics as $dayStatistic){
                $date = Carbon::parse($dayStatistic->date)->format($this->chartIntervals->getIntervalDateFormat());
                $i = $this->shiftIndex($i, $this->labels, $date);
                $data[$i] = $dayStatistic->amount_sum * -1;
            }

            $result[] = (object)[
                'label' => $category->name,
                'backgroundColor' => $category->color,
                'borderColor' => $category->color,
                'data' => $data,
            ];
        }
        $this->chartData = $result;
    }


    private function shiftIndex($currentIndex, $array, $needKey): int
    {
        for ($i = $currentIndex; $i < count($array); $i++) {
            if ($array[$i] == $needKey) {
                return $i;
            }
        }
        return 0;
    }

}
