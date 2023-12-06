<?php

namespace App\Services\Statistics\StatisticUpdaters;

use App\Models\Category;
use App\Models\payments\BankPayment;
use App\Models\statistics\DayStatistic;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class MonthStatisticUpdater extends StatisticUpdater
{

    protected function update(User $user, Carbon $start, Carbon $end)
    {
        //todo: не плохо бы сделать декоратор, лимитирующий количество данных за раз

        $categories = $user->categories()->with(['dayStatistics' => function (Builder $query) use ($start, $end) {
            $query->whereBetween('date',[$start, $end]);
        }])->get();
        foreach ($categories as $category){
             $groupDates = $category->dayStatistics->groupBy(function($bankPayment) {
                 return Carbon::parse($bankPayment->date)->format('Y-m-1'); // Сгруппировать результат по месяцу
             });
             foreach ($groupDates as $key => $groupDate){
                 $category->monthStatistics()->updateOrCreate([
                     'date' => $key
                     ],
                     [
                         'amount_sum' => $groupDate->sum('amount_sum')
                     ]
                 );
             }
        }
    }
}
