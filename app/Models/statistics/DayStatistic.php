<?php

namespace App\Models\statistics;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property string date
 */
class DayStatistic extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $guarded = ['id'];
}
