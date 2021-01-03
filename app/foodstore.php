<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
// class foodstore extends Model
class foodstore extends Pivot
{
    protected $table = 'foodstore';
    
    protected $primaryKey = ['id_food','id_store'];

   
    public $incrementing = false;
    
}
