<?php

namespace App\Queues\Handlers;

use App\Models\users\User;
use App\Services\Statistics\StatisticUpdaters\DayStatisticUpdater;
use App\Services\Statistics\StatisticUpdaters\MonthStatisticUpdater;
use Carbon\Carbon;

class StatisticsUpdateHandler implements QueueHandlerInterface
{

    public function handle($msg): void
    {
        $data = json_decode($msg->body);
        $user = User::query()->find($data->user_id);
        $start = Carbon::parse($data->start);
        $end = Carbon::parse($data->end);

        $updaterMonth = new MonthStatisticUpdater();
        $updater = new DayStatisticUpdater($updaterMonth);
        $updater->startUpdate($user, $start, $end);
    }
}
