<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
class emp extends Authenticatable
{
    protected $table = 'emp';
    
    protected $primaryKey ='id_emp';

    protected $fillable = [
        'username',
        'password',
        'name_emp',
        'birth_emp',
        'gender_emp',
        'per_emp',
        'state_emp'
    ];

    protected $guarded = ['*'];
    const     CREATED_AT    = 'created_at';
    const     UPDATED_AT    = 'updated_at';
    protected $dates        = ['created_at', 'updated_at','birth_emp'];

    


    public function rate()
    {
        return $this->hasMany('App\rate', 'id_emp', 'id_emp');
    }
    public function bill()
    {
        return $this->hasMany('App\bill', 'id_emp', 'id_emp');
    }
    public function comment()
    {
        return $this->hasMany('App\comment', 'id_emp', 'id_emp');
    }

    public function getAuthPassword(){
        return $this->password;
    }
}
