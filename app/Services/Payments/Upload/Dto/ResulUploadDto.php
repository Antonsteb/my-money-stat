<?php

namespace App\Services\Payments\Upload\Dto;

use Carbon\Carbon;

class ResulUploadDto
{
    private int $countPaymentsLoaded = 0;
    private Carbon $minDate;
    private Carbon $maxDate;

    public function getCountPaymentsLoaded(): int
    {
        return $this->countPaymentsLoaded;
    }

    public function setCountPaymentsLoaded(int $countPaymentsLoaded): void
    {
        $this->countPaymentsLoaded = $countPaymentsLoaded;
    }

    public function getMinDate(): Carbon
    {
        return $this->minDate;
    }

    public function setMinDate(Carbon $minDate): void
    {
        if (!isset($this->maxDate) || $minDate < $this->minDate) {
            $this->minDate = $minDate;
        }
    }

    public function getMaxDate(): Carbon
    {
        return $this->maxDate;
    }

    public function setMaxDate(Carbon $maxDate): void
    {
        if (!isset($this->maxDate) || $maxDate > $this->maxDate) {
            $this->maxDate = $maxDate;
        }
    }
}
