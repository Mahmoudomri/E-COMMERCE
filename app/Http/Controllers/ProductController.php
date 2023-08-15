<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
;
class ProductController extends Controller
{
    public function index(){
        $products= Product::all();
        $categories=Category::all();
        return view('admin.products.index')->with('products',$products)->with('categories',$categories);
       
    }
    public function store (Request $request){

        $Product=new Product();
        $Product->name=$request->name;
        $Product->category_id=$request->categorie;
        $Product->description=$request->description;
        $Product->price=$request->price;
        $Product->qte=$request->qte;
        //upload image
        $newname=uniqid();
        $image=$request->file('photo');
        $newname.=".".$image->getClientOriginalExtension();
        $destinationPath='uploads';
        $image->move($destinationPath,$newname);
        $Product->photo=$newname;

        if($Product->save()){
            return redirect()->back();
        } else{
            echo "error";
        }
    }

    public function delete ($id){
       
        $product=Product::find($id);
        $file_path= public_path().'/uploads/'.$product->photo;
        unlink($file_path);
        if($product->delete()){
            return redirect()->back();
        }else{
            echo"error";
        }


    }
    public function update (Request $request){

        $Product= Product::find($request->idproduit);
        
        $Product->name=$request->name;
        $Product->description=$request->description;
        $Product->price=$request->price;
        $Product->qte=$request->qte;
        
        //dd($Product);
        if($request->file('photo')){
            //supprimer image
       
        $file_path= public_path().'/uploads/'.$Product->photo;
        unlink($file_path);
        //inserer autre image
        $newname=uniqid();
        $image=$request->file('photo');
        $newname.=".".$image->getClientOriginalExtension();
        $destinationPath='uploads';
        $image->move($destinationPath,$newname);
        $Product->photo=$newname;


        }
      ;

         if($Product->update()){
            return redirect()->back();
         } else{
         echo "error";
         }
    }

public function searchproduct (Request $request){

           if($request->product_name && !$request->qte) {

            $products=Product::where('name','LIKE','%'.$request->product_name.'%')->get();

           } 
           if(!$request->product_name && $request->qte) {
            $products=Product::where('qte','>=',$request->qte)->get();
            
           }
           if($request->product_name && $request->qte) {
            $products=Product::where('name','LIKE','%'.$request->product_name.'%')->where('qte','>=',$request->qte)->get();
            
           }
           if(!$request->product_name && !$request->qte) {
            $products=Product::all();
            
           }
           
            $categories=Category::all();
            return view('admin.products.index')->with('products',$products)->with('categories',$categories);

}



    


}
