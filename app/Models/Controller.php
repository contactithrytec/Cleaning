<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Controller extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable=[
        'user_id','residence_id'
    ];

    public function user(){
        return $this->belongsTo('App\Models\User','user_id');
    }

    public function residence(){
        return $this->belongsTo('App\Models\Residence','residence_id');
    }

}
