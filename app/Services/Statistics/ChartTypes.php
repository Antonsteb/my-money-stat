<?php

namespace App\Services\Statistics;

use App\Services\Statistics\ChartDataFormates\ChartDataFormat;
use App\Services\Statistics\ChartDataFormates\Formatters\BarFormat;
use App\Services\Statistics\ChartDataFormates\Formatters\LineFormat;
use App\Services\Statistics\ChartDataFormates\Formatters\NumberAvgFormat;
use App\Services\Statistics\ChartDataFormates\Formatters\NumberSumFormat;
use App\Services\Statistics\ChartDataFormates\Formatters\PieFormat;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

enum ChartTypes:string
{
    case NumberSum = 'number-sum';
    case NumberAvg = 'number-avg';
    case Line = 'line';
    case Bar = 'bar';
    case Pie = 'pie';

    public static function getValueNameList(): array
    {
        return [
            self::NumberSum->value => 'Сумма',
            self::NumberAvg->value => 'Среднее значение',
            self::Line->value => 'Линия',
            self::Bar->value => 'Столбец',
            self::Pie->value => 'Круговая',
        ];
    }


    public function getDataFormatter(
        Carbon $startDat,
        Carbon $endDate,
        ChartIntervals $chartIntervals,
        Collection $categories
    ):ChartDataFormat
    {
        return match ($this) {
            self::NumberSum => new NumberSumFormat($startDat, $endDate, $chartIntervals, $categories),
            self::NumberAvg => new NumberAvgFormat($startDat, $endDate, $chartIntervals, $categories),
            self::Line => new LineFormat($startDat, $endDate, $chartIntervals, $categories),
            self::Bar => new BarFormat($startDat, $endDate, $chartIntervals, $categories),
            self::Pie => new PieFormat($startDat, $endDate, $chartIntervals, $categories),
        };
    }


}
