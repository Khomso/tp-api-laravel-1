<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Console extends Model
{
    use HasFactory;
    protected $fillable =['nomConsole','joueur_id'];

    public function jeux()
    {
            //Relation many to many avec producers
        return $this->belongsToMany('App\Models\Jeux');
    }

}
