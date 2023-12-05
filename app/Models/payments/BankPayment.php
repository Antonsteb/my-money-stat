<?php

namespace App\Models\payments;

use App\Models\Category;
use App\Services\Payments\Banks;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int id
 * @property Category[] categories
 */
class BankPayment extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $casts = [
        'bank_name' => Banks::class,
    ];
    protected $fillable = [
        'bank_name',
        'bank_category_name',
        'description',
        'price',
        'date',
    ];


    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class,'bank_payment_categories',
            'bank_description','category_id','description');
    }
}
