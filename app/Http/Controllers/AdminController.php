<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
     /// fonction qui permet d afficher le dashboard admin
    public function dashboard(){
        return view('admin.dashboard');
    }

    public function profile(){
        return view('admin.profile');
    }

    public function update( Request $request){
        
        
        Auth::user()->name=$request->name;
        Auth::user()->email=$request->email;
        if($request->password){
        Auth::user()->password=Hash::make($request->password);}
            

        Auth::user()->update();

        return redirect ('/admin/profile')->with('success', 'Admin modifie avec succes..!');
        
    }

    public function users (){

        $clients=User::where('role','user')->get();

        return view('admin.users.index')->with('clients',$clients);
    }
    public function Bloqer ($iduser){

        $client=User::find($iduser);
        $client->is_active=false;
        $client->update();

        return redirect()->back()->with('success','Client bloquee');
    }

      public function Debloqer ($iduser){

        $client=User::find($iduser);

        if (!$client->is_active){
        $client->is_active=true;
        $client->update();

        return redirect()->back()->with('success','Client Active');}
        else {

            return redirect()->back();
        }
    }

    public function commandes (){

        $commandes=Commande::all();
        return view('admin.commandes.index')->with('commandes',$commandes);


    }
}
