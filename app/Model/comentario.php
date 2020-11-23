<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class comentario extends Model
{
    protected $table ='comentarios';

    public function persona(){//cuaderno
        return $this->belongsTo(user::class);
    }

    public function producto(){
        return $this->belongsTo(producto::class);
    }

}
