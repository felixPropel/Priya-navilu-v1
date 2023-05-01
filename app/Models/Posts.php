<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    use HasFactory;
    protected $table="posts";

    public function category()
    {
        return $this->hasMany(PostsCategory::class,'post_id');
    }
    public function tags()
    {
        return $this->hasMany('App\Models\PostsTags', 'post_id', 'id');
    }
    public function ratings()
    {
        return $this->hasOne('App\Models\ratings', 'id', 'rating_id');
    }
    public function images()
    {
        return $this->hasMany('App\Models\PostsImages', 'post_id', 'id');
    }

    public function pdf()
    {
        return $this->hasMany('App\Models\PostPdf', 'post_id', 'id');
    }

}
