<?php

namespace App\Models\payments;

use App\Models\users\User;
use App\Services\Payments\Banks;
use App\Services\Payments\Upload\TypeLoader;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $count_payments
 * @property User $user
 * @property Banks $bank_name
 * @property TypeLoader $type
 */
class PaymentsUpload extends Model
{
    use HasFactory;

    protected $casts = [
        'bank_name' => Banks::class,
        'type' => TypeLoader::class
    ];
    protected $fillable = [
        'bank_name',
        'type'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
