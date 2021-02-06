<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $table='posts';
    protected $fillable=[   'title',
    'keywords',
    'content',
    'category_id',
    'author_id',
    'description',
    'image_file'];

    public function Category(){
        return $this->belongsTo('App\Models\Category');
    }
    public function Author(){
        return $this->belongsTo('App\Models\User','author_id','id');
    }
    public function Comments(){
        return $this->hasMany('App\Models\Comment');
    }
    public function Likes(){
        return $this->hasMany('App\Models\Like');
    }

}
