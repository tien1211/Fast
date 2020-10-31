<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class store extends Model
{
    protected $table = 'store';
    
    protected $primaryKey ='id_store';

    protected $fillable = [
        'id_address',
        'name_store',
        'phone_store',
        'state_store'
    ];

    protected $guarded = ['*'];
    const     CREATED_AT    = 'created_at';
    const     UPDATED_AT    = 'updated_at';
    protected $dates        = ['created_at', 'updated_at'];


    public function address()
    {
        return $this->belongsTo('App\address', 'id_address', 'id_address');
    }


    public function foodstore()
    {
        return $this->hasMany('App\foodstore', 'id_store', 'id_store');
    }
}
