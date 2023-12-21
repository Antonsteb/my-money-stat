<?php

namespace App\Services\Statistics;

enum ChartTypes:string
{
    case NumberSum = 'number-sum';
    case NumberAvg = 'number-avg';
    case Line = 'line';
    case Bar = 'bar';

    public static function getValueNameList(): array
    {
        return [
            self::NumberSum->value => 'Сумма',
            self::NumberAvg->value => 'Среднее значение',
            self::Line->value => 'Линия',
            self::Bar->value => 'Столбец',
        ];
    }

}
