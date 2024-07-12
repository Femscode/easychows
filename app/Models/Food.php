<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    public function category() {
        return $this->belongsTo(Category::class,'category_id');
    }
    
    protected $guarded = [];
    protected $table = 'food';
    use HasFactory;
}
