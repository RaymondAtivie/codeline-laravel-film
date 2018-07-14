<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Film extends Model
{
    protected $hidden = ['updated_at', 'pivot'];
    protected $dates = ['release_date'];

    public function getPhotoAttribute($path){
        return url(Storage::url($path));
    }

    //Relationships
    public function genres(){
        return $this->belongsToMany('App\Genre');
    }
}
