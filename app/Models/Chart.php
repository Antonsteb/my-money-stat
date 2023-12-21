<?php

namespace App\Models;

use App\Services\Statistics\ChartIntervals;
use App\Services\Statistics\ChartTypes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int id
 * @property ChartTypes type
 * @property ChartIntervals interval
 * @property int x
 * @property int y
 * @property int w
 * @property int h
 * @property int i
 * @property Category[] categories
 */
class Chart extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $casts = [
        'type' => ChartTypes::class,
        'interval' => ChartIntervals::class,
    ];
    protected $guarded = ['id'];


    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }
}
