<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class bill extends Model
{
    protected $table = 'bill';
    
    protected $primaryKey ='id_bill';

    protected $fillable = [
        'id_emp',
        'id_del',
        'date_bill',
        'name_bill',
        'address_bill',
        'mail_bill'
        
    ];

    // protected $guarded = ['*'];
    const     CREATED_AT    = 'created_at';
    const     UPDATED_AT    = 'updated_at';
    protected $dates        = ['created_at', 'updated_at'];

    public function emp()
    {
        return $this->belongsTo('App\emp', 'id_emp', 'id_emp');
    }
    public function delivery()
    {
        return $this->belongsTo('App\delivery', 'id_del', 'id_del');
    }
    

    public function billdetail()
    {
        return $this->hasMany('App\billdetail', 'id_bill', 'id_bill');
    }

}
