<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
   
    protected  $primaryKey='id';
    protected $table='video';
    protected $fillable=['id','video','name','title','duration'];
    
    
    
}
