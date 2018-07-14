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

    public function getReleaseDateAttribute($date){
        $d = new \Carbon\Carbon($date);
        return $d->format("d M Y");
    }

    public function getTicketPriceAttribute($price){
        return "$".number_format($price);
    }

    //Relationships
    public function genres(){
        return $this->belongsToMany('App\Genre');
    }
}
