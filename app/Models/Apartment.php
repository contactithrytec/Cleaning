<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Apartment extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable=[
        'num','name','priority','note','residence_id','type_id'
    ];

    public function TypeApartment(){
        return $this->belongsTo('App\Models\Type','type_id');
    }

    public  function ResidenceApartment(){
        return $this->belongsTo('App\Models\Residence','residence_id');
    }

    public function Groupes(){

        return $this->belongsToMany('App\Models\Groupe','appartment_groupes');
    }




}
