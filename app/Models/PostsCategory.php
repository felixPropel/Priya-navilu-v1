<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostsCategory extends Model
{
    use HasFactory;
    protected $table="post_categories";

    public function category()
    {
        return $this->hasMany(Category::class,'id','category_id');
    }

}
