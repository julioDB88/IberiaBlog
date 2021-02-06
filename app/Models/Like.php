<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;
    use HasFactory;
    protected $table='likes';
    protected $fillable=['user_id','post_id'];
    public $timestamps=false;

    public function Post(){
        return $this->belongsTo('App\Models\Post');
    }
    public function User(){
        return $this->belongsTo('App\Models\User',);
    }
}
