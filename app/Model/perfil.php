<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class perfil extends Model
{
    protected $table ='perfiles';
    
    public function comentario(){
        return $this->hasMany(comentario::class);
    }
    public function perfil(){
        return $this->belongsTo(user::class);
    }

}
