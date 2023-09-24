<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Residence extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable=[
       'name','user_id'
    ];

    public function UserResidence(){
        return $this->belongsTo('App\Models\User','user_id');
    }

    public  function Apartments(){
        return $this->hasMany('App\Models\Apartment');
    }

    public function Controllers(){
        return $this->hasMany('App\Models\Controller');
    }


}
