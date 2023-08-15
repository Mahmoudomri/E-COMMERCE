<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Commande;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use function PHPUnit\Framework\returnSelf;

class ClientController extends Controller
{
     /// fonction qui permet d afficher le dashboard client
     public function dashboard(){
        return view('user.dashboard');
    }
    public function profile (){
        return view('user.profile');
    }
    public function update( Request $request){
        
        
        Auth::user()->name=$request->name;
        Auth::user()->email=$request->email;
        if($request->password){
        Auth::user()->password=Hash::make($request->password);}
            

        Auth::user()->update();

        return redirect ('/user/profile')->with('success', 'Admin modifie avec succes..!');
        
    }

    public function addreview(Request $request){
        $review=new Review();
        $review->rate=$request->rate;
        $review->product_id=$request->product_id;
        $review->content=$request->content;
        $review->user_id=Auth::user()->id;
        
        $review->save();
        return redirect()->back();

    }

    public function cart (){
        $categories=Category::all();
        $commande=Commande::where('client_id',Auth::user()->id)->where('etat','en cours')->first();
        return view('guest.cart')->with('categories',$categories)->with('commande',$commande);
    }

    public function checkout (Request $request){

        $commande=Commande::find($request->commande);
       // dd($commande->getTotal());
        $commande->etat= "payee";
        $commande->update();
        return redirect('/user/dashboard')->with('success','commande payee avec succes...!');
    }

   // public function mescommandes(){

       // return view('user.commandes');
   // }
public function commandes(){

    return view ('user.commandes'); }


    public function affichermessagebloquee (){

        return view ('user.bloquer');
    }

}

