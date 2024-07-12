<?php

namespace App\Models;
// use App\Models\Order;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Order;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;


class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $guarded = [];
    protected $table = 'users';

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }
    public function working_hour()
    {
        return  $this->hasMany('App\Models\WorkingHour', 'vendor_id', 'id');
    }
    public function get_school($id) {
        return School::find($id);

    }
    // User.php

    public function isOpenNow($current_time)
    {
        if ($this->working_hour->isEmpty() || $this->working_hour[0]->availability == 0) {
            return false; // No working hours or availability is 0, consider as closed
        }

        $currentWorkingHour = $this->working_hour->first();
        // return $currentWorkingHour;
        // return $current_time;
        // return $currentWorkingHour->opening_hour;
        

        return $current_time >= $currentWorkingHour->opening_hour
            && $current_time <= $currentWorkingHour->closing_hour;
    }
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
