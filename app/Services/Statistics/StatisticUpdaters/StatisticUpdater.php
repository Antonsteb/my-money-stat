<?php

namespace App\Services\Statistics\StatisticUpdaters;

use App\Models\User;
use Carbon\Carbon;

abstract class StatisticUpdater
{

    protected StatisticUpdater | false $next;
    public function __construct(StatisticUpdater | false $next = false)
    {
        $this->next = $next;
    }

    public function startUpdate(User $user, Carbon $start, Carbon $end): void
    {
        $this->update($user, $start, $end);
        if ($this->next) {
            $this->next->startUpdate($user, $start, $end);
        }
    }

    abstract protected function update(User $user, Carbon $start, Carbon $end);
}
