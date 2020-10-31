<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class rate extends Model
{
    protected $table = 'rate';
    
    protected $primaryKey ='id_rate';

    protected $fillable = [
        'id_food',
        'id_emp',
        'number_rate',
        'state_rate'
    ];

    protected $guarded = ['*'];
    const     CREATED_AT    = 'created_at';
    const     UPDATED_AT    = 'updated_at';
    protected $dates        = ['created_at', 'updated_at'];

    public function food()
    {
        return $this->belongsTo('App\food', 'id_food', 'id_food');
    }
    public function emp()
    {
        return $this->belongsTo('App\emp', 'id_food', 'id_food');
    }
}
