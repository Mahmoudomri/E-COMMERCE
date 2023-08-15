<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $categories= Category::all();
        return view('admin.categories.index')->with('categories',$categories);
       
    }

    public function store (Request $request){

        $request->validate(
            [
                'name'=>'required',
                'description'=>'required'
            ]
            );
            $category=new Category();
            $category->name=$request->name;
            $category->description=$request->description;

            $category->save();
            return redirect()->back();

    }
    public function delete ($id){
        $categorie=Category::find($id);
        if($categorie->delete()){
            return redirect()->back();
        }else{
            echo"error";
        }


    }

    public function update (Request $request ){

        $request->validate(
            [
                'name'=>'required',
                'description'=>'required'
            ]
            );
            $id=$request->id_category;
            $category=Category::find($id);
            $category->name=$request->name;
            $category->description=$request->description;
            
            if($category->update()){
                return redirect()->back();
            }else{
                echo"error";
            }
}}
