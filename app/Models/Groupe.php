<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Groupe extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable=[
     'name','status','is_controlled',
    ];

    public function Apartments(){
        return $this->belongsToMany('App\Models\Apartment','appartment_groupes');
    }

    public  function Agents(){
        return $this->belongsToMany('App\Models\User','user_groupes');
    }
}
