<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;
    public function lignecommandes(){

        return $this->hasMany(LigneCommande::class,'commande_id','id');
    }
    public function client()
    {
        return $this->belongsTo(User::class, 'client_id', 'id');
    }

    public function getTotal (){

        $total=0;

       foreach  ($this->lignecommandes as $lc) {

        $total += $lc->product->price * $lc->qte ;
       }
       return $total;
    }
}
