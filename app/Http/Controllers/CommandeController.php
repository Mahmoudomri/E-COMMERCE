<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\LigneCommande;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommandeController extends Controller
{
    //
    public function store (Request $request){
    //dd($request);
    //verifie is une commande en cours pour ce client

    $commande=Commande::where('client_id',Auth::user()->id)->where('etat','en cours')->first();
    if($commande){ // commande en cours existe
        //check if product exist
        $existe=false;
        foreach($commande->lignecommandes as $lignec ) {
            if($lignec->product_id == $request->idproduct){

                $existe=true;
                $lignec->qte += $request->qte;
                $lignec->update();
            }


        }

        if(!$existe){
        $lc= new LigneCommande();
        $lc->qte=$request->qte;
        $lc->product_id=$request->idproduct;
        $lc->commande_id=$commande->id;
        $lc->save();
            echo "produit commandee";}
            
      return redirect('/user/cart')->with('success','le produit commandee');
    }else { //commande n exist pas
        $commande=new Commande();
        $commande->client_id=Auth::user()->id;
    
        //creation ligne de commande
        if ( $commande->save()){
        $lc= new LigneCommande();
        $lc->qte=$request->qte;
        $lc->product_id=$request->idproduct;
        $lc->commande_id=$commande->id;
        $lc->save();
      //  echo "produit commandee";
        
        return redirect('/user/cart')->with('success','le produit commandee');
    }else {
    
            return redirect()->back()->with('error','impossible de commander le produit');
        }
    

    }

    


    }

    public function lignedelete ($idlc){
        $lc=LigneCommande::find($idlc);
        $lc->delete();
        return redirect()->back()->with('success','Ligne de commande  supprimee');




    }
}
