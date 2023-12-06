<?php

namespace App\Models;

use App\Models\payments\BankPayment;
use App\Models\statistics\DayStatistic;
use App\Models\statistics\MonthStatistic;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int id
 * @property Category parentCategory
 * @property Category[] subcategories
 * @property BankPayment[] bankPayments
 * @property DayStatistic[] dayStatistics
 * @property MonthStatistic[] monthStatistics
 */
class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';

    protected $fillable = [
        'parent_id',
        'name',
        'color'
    ];


    public function parentCategory(): HasOne
    {
        return $this->hasOne(Category::class,'id','parent_id');
    }
    public function subcategories(): HasMany
    {
        return $this->hasMany(Category::class,'parent_id','id');
    }
    public function bankPayments(): BelongsToMany
    {
        return $this->belongsToMany(BankPayment::class,'bank_payment_categories',
            'category_id','bank_description','id','description');
    }

    public function dayStatistics(): HasMany
    {
        return $this->hasMany(DayStatistic::class);
    }
    public function monthStatistics(): HasMany
    {
        return $this->hasMany(MonthStatistic::class);
    }
}
