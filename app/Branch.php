<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{

    protected $table ='brach';
    protected $guarded =[];

    public function user()
    {
        return $this->hasMany('App\User','branch_id');
    }
}
