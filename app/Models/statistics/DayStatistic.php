<?php

namespace App\Models\statistics;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DayStatistic extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $guarded = ['id'];
}
