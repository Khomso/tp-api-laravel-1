<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jeux extends Model
{
    use HasFactory;
    protected $fillable = ['nomJeux','categorieJeux'];

    public function console()
    {
            //Relation many to many avec producers
        return $this->belongsToMany('App\Models\Console');
    }

}

