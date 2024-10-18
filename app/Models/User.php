<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;



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
        'type',
        'email',
        'password',
        'mobile',
        'city',
        'address',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'api_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }


    public static function boot() {
        parent::boot();
        self::deleting(function($user) { // before delete() method call this
             $user->products()->each(function($product) {
                $product->delete(); // <-- direct deletion
             });
        });

}

protected static function booted()
{
    static::deleting(function ($user) {
        $user->actions()->detach();
    });
}

    public function generateToken()
    {
        $token =   Str::random(100);
        $this->api_token = $token;
        $this->save();
        return $token;
    }
}
