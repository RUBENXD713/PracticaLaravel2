<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Personas extends Model
{
    protected $table = "Personas";
    public $timetamps=false;

    public function Comentarios()
    {
        return $this->hasMany('App\Comentarioss');
        //una persona tiene muchos comentarios
    }
}
