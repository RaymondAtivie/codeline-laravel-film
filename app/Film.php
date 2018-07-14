<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    protected $hidden = ['updated_at', 'pivot'];
    protected $dates = ['release_date'];

    //Relationships
    public function genres(){
        return $this->belongsToMany('App\Genre');
    }
}
