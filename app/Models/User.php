<?php

namespace App\Models;
use App\Models\Order;
use App\Models\Image;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;


class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        // 'admin_since',
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
    protected $dates = [
        'admin_since',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class,'customer_id');
    }
    public function Payments()
    {
        return $this->hasManyThrough(Payment::class,Order::class,'customer_id');
    }
    public function image()
    {
        return $this->morphOne(Image::class,'imageable');
    }

    public function isAdmin()
    {
        // return $this->admin_since != null && $this->admin_since->lessThanOrEqualTo(now());
        if (empty($this->admin_since)) {
            return false;
        }

        // Convert the 'admin_since' string to a Carbon instance
        $adminSince = Carbon::parse($this->admin_since);

        // Compare the date to the current date
        return $adminSince->lessThanOrEqualTo(Carbon::now());
    }
}
