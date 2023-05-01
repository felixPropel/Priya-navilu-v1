<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table="category";

    public function postscategory()
    {
        return $this->belongsTo(PostsCategory::class, 'category_id', 'id');
    }

    

}
