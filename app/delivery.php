<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class delivery extends Model
{
    protected $table = 'delivery';
    
    protected $primaryKey ='id_del';

    protected $fillable = [
        
        'state_del'
    ];

    protected $guarded = ['*'];
    const     CREATED_AT    = 'created_at';
    const     UPDATED_AT    = 'updated_at';
    protected $dates        = ['created_at', 'updated_at'];

    public function bill()
    {
        return $this->hasMany('App\bill', 'id_del', 'id_del');
    }
}
