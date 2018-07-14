<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $hidden = ['updated_at', 'pivot'];
    
    //Relationships
    public function films(){
        return $this->belongsToMany('App\Film');
    }
}
