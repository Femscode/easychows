<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscountedUser extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'discounted_users';
    public function restaurant() {
      
        return $this->belongsTo(User::class,'restaurant_id','id');
    }
}
