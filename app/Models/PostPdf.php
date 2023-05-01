<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostPdf extends Model
{
    use HasFactory;


    public function ParentTable()
    {
        return $this->belongsTo(Posts::class, 'post_id', 'id');
    }
}
