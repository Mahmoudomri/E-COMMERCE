<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function home(){
        $produits=Product::all();  //recupere tout les produits de la BD
        $categories=Category::all();//recupere tout les categories de la BD
        return view('guest.home')->with('produits',$produits)->with('categories',$categories);
    }

    public function productDetails($id){
        $product=Product::find($id);
        $produits=Product::where('id','!=',$id)->get();
        $categories=Category::all();
        return view('guest.product-details')->with('categories',$categories)->with('product',$product)->with('produits',$produits);
    }
    public function shop ($categoryid){
        $category=Product::find($categoryid);
        $products=Product::where('category_id',$categoryid)->get();
        $categories=Category::all();//recupere tout les categories de la BD
        return view('guest.shop')->with('categories',$categories)->with('products',$products);
    }
    public function search (Request $request ){
        $categories=Category::all();
        $products=Product::where('name','Like','%'.$request->keywords.'%')->get();
        return view('guest.shop')->with('categories',$categories)->with('products',$products);
    }
}
