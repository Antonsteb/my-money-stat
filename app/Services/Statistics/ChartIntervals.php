<?php

namespace App\Services\Statistics;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\HasMany;

enum ChartIntervals:string
{
    case Day = 'day';
    case Month = 'month';
//    case Year = 'year';

    public static function getValueNameList(): array
    {
        return [
            self::Day->value => 'День',
            self::Month->value => 'Месяц',
//            self::Year->value => 'Год',
        ];
    }

    public function getIntervalString():string
    {
        return match ($this){
            self::Day => '1 days',
            self::Month => '1 months'
        };
    }
    public function getIntervalDateFormat():string
    {
        return match ($this){
            self::Day => 'd-m',
            self::Month => 'm-Y'
        };
    }

    public function getChartDataQueryBuilder(Category $category): HasMany
    {
        return match ($this){
            self::Day => $category->dayStatistics(),
            self::Month => $category->monthStatistics(),
        };
    }

}
