<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    protected $table = 'category';
    
    protected $primaryKey ='id_cate';

    protected $fillable = [
        'name_cate',
        'img_cate',
        'state_cate'
    ];

    protected $guarded = ['*'];
    const     CREATED_AT    = 'created_at';
    const     UPDATED_AT    = 'updated_at';
    protected $dates        = ['created_at', 'updated_at'];

    public function food()
    {
        return $this->hasMany('App\category', 'id_cate', 'id_cate');
    }
}
