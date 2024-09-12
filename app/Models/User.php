<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'address',
        'country',
        'province',
        'city',
        'postal_code',
        'district',
        'roles',
        'photo',
        'is_livestreaming',
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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    //hasmany product
    public function products(){
        return $this->hasMany(Product::class, 'seller_id');
    }

    //hasmany order
    public function orders(){
        return $this->hasMany(Order::class);
    }

    //category
    public function categories(){
        return $this->hasMany(Category::class);
    }

    //address
    public function addresses(){
        return $this->hasMany(Address::class);
    }
}
