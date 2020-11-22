<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class address extends Model
{
    protected $table = 'address';
    
    protected $primaryKey ='id_address';

    protected $fillable = [
        'number_address',
        'street_address',
        'district_address',
        'state_address',
    ];

    protected $guarded = ['*'];
    const     CREATED_AT    = 'created_at';
    const     UPDATED_AT    = 'updated_at';
    protected $dates        = ['created_at', 'updated_at'];

    public function store()
        {
            return $this->hasOne('App\store', 'id_address', 'id_address');
        }
    

    
}
