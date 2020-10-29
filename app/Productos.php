<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    protected $table = "Productos";
    public $timetamps=false;
    public function Comentarios()
    {
        return $this->hasMany('App\Comentarioss');
        //un producto tiene muchos comentarios
    }
}
