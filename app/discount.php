<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class discount extends Model
{
    protected $table = 'discount';
    
    protected $primaryKey ='id_dis';

    protected $fillable = [
        'content_dis',
        'start_dis',
        'end_dis',
        'state_dis'
    ];

    protected $guarded = ['*'];
    const     CREATED_AT    = 'created_at';
    const     UPDATED_AT    = 'updated_at';
    protected $dates        = ['created_at', 'updated_at','start_dis', 'end_dis'];

    public function food()
    {
        return $this->hasMany('App\food', 'id_dis', 'id_dis');
    }
}
