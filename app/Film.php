<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    protected $hidden = ['updated_at', 'pivot'];

    //Relationships
    public function genres(){
        return $this->belongsToMany('App\Genre');
    }
}
