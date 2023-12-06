<?php

namespace App\Models;

use App\Services\Statistics\ChartTypes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Chart extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $casts = [
        'type' => ChartTypes::class,
    ];
    protected $guarded = ['id'];


    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }
}
