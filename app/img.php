<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class img extends Model
{
    protected $table = 'img';
    
    protected $primaryKey ='id_img';

    protected $fillable = [
        'id_food',
        'file_img',
        'state_img'
    ];

    protected $guarded = ['*'];
    const     CREATED_AT    = 'created_at';
    const     UPDATED_AT    = 'updated_at';
    protected $dates        = ['created_at', 'updated_at'];


    public function food()
    {
        return $this->belongsTo('App\food', 'id_food', 'id_food');
    }
}
