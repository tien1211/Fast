<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class food extends Model
{
    protected $table = 'food';
    
    protected $primaryKey ='id_food';

    protected $fillable = [
        'id_cate',
        'id_dis',
        'name_food',
        'desc_food',
        'price_food',
        'preprice_food',
        'state_food'
    ];

    protected $guarded = ['*'];
    const     CREATED_AT    = 'created_at';
    const     UPDATED_AT    = 'updated_at';
    protected $dates        = ['created_at', 'updated_at'];


    public function discount()
    {
        return $this->belongsTo('App\discount', 'id_dis', 'id_dis');
    }
    public function category()
    {
        return $this->belongsTo('App\category', 'id_cate', 'id_cate');
    }

    public function store()
    {
        return $this->belongsToMany('App\store', 'foodstore', 'id_food', 'id_store');
    } 
    

    public function foodstore()
    {
        return $this->hasMany('App\foodstore', 'id_food', 'id_food');
    }
    public function comment()
    {
        return $this->hasMany('App\comment', 'id_food', 'id_food');
    }
    public function rate()
    {
        return $this->hasMany('App\rate', 'id_food', 'id_food');
    }
    public function billdetail()
    {
        return $this->hasMany('App\billdetail', 'id_food', 'id_food');
    }
    public function img()
    {
        return $this->hasMany('App\img', 'id_food', 'id_food');
    }
}
