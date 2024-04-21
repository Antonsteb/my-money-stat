<?php

namespace App\Models\users;

use App\Models\Category;
use App\Models\Chart;
use App\Models\payments\BankPayment;
use App\Models\payments\PaymentsUpload;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property int id
 * @property PaymentsUpload[] paymentsUpload
 * @property BankPayment[] bankPayments
 * @property Category[] categories
 * @property Chart[] charts
 * @property SocialAccount[] socialAccounts
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function paymentsUpload(): HasMany
    {
        return $this->hasMany(PaymentsUpload::class);
    }

    public function bankPayments(): HasMany
    {
        return $this->hasMany(BankPayment::class);
    }

    public function categories(): HasMany
    {
        return $this->hasMany(Category::class);
    }

    public function charts(): HasMany
    {
        return $this->hasMany(Chart::class);
    }


    public function socialAccounts(): HasMany
    {
        return $this->hasMany(SocialAccount::class);
    }
}
