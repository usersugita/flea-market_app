<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'user_id', 'condition', 'description', 'image', 'name', 'price'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_category');
    }
    
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
