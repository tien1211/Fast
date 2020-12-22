<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    protected $table = 'comment';
    
    protected $primaryKey ='id_cmt';

    protected $fillable = [
        'id_food',
        'id_emp',
        'idfather_cmt',
        'content_cmt',
        'state_cmt'
    ];

    protected $guarded = ['id_cmt'];
    const     CREATED_AT    = 'created_at';
    const     UPDATED_AT    = 'updated_at';
    protected $dates        = ['created_at', 'updated_at'];


    public function food()
    {
        return $this->belongsTo('App\food', 'id_food', 'id_food');
    }
    public function emp()
    {
        return $this->belongsTo('App\emp', 'id_emp', 'id_emp');
    }

    public function replies() {
        return $this->hasMany('App\comment', 'idfather_cmt','id_cmt');
    }
}
