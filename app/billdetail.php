<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class billdetail extends Model
{
    protected $table = 'billdetail';
    
    protected $primaryKey =['id_bill','id_food'];

    protected $fillable = [
        'id_bill',
        'id_food',
        'qty_billdetail',
        'price_billdetail',
        'state_billdetail',
    ];

    protected $guarded = ['*'];
    const     CREATED_AT    = 'created_at';
    const     UPDATED_AT    = 'updated_at';
    protected $dates        = ['created_at', 'updated_at'];

    public function food()
    {
        return $this->belongsTo('App\food', 'id_food', 'id_food');
    }
    public function bill()
    {
        return $this->belongsTo('App\bill', 'id_bill', 'id_bill');
    }

}
