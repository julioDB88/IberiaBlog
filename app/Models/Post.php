<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $table='posts';
    protected $fillable=['title',
    'keywords',
    'content',
    'category_id',
    'author_id',
    'description',
    'img_file'];

    public function Category(){
        return $this->belongsTo('App\Models\Category');
    }

    public function Author(){
        return $this->hasOne(User::class,'id','author_id');
    }

    public function Comments(){
        return $this->hasMany('App\Models\Comment');
    }

    public function ActiveComments(){
        return $this->Comments()->where('visible',1);
    }

    public function Likes(){
        return $this->hasMany('App\Models\Like');
    }

}
