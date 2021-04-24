<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Heroe extends Model
{
    //
    protected $table = 'heroes';

    protected $fillable = ['nombre', 'poder'];
    
}
