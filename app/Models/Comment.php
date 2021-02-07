<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $table='comments';
    protected $fillable=[ 'name','email','post_id','comment','visible'];

    public function Post(){
        return $this->belongsTo('App\Models\Post');
    }
    public function User(){
        return $this->belongsTo('App\Models\User',);
    }

}
