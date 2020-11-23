<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class producto extends Model
{
    protected $table ='productos';
    
    public function comentario(){
        return $this->hasMany(comentario::class);
    }
}
