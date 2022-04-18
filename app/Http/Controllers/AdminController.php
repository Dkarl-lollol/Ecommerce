<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;


class AdminController extends Controller
{
    public function product()
    {
        return view('admin.product');
    }

    public function uploadproduct(Request $request)
    {
        $data=new product;
        $data->title=$request->title;
        $data->price=$request->price;
        $data->description=$request->des;
        $data->quantity=$request->quantity;

        if ($request->hasFile('file')){

            $image=$request->file;

            $imagename=time().'.'.$image->getClientOriginalExtension();

            $request->file->move('productimage',$imagename);

            $data->image=$imagename;
        }
       
        $data->save();

        return redirect()->back()->with('message', 'Product added successfully');

    }

    public function showproduct()
    {
        $data=product::all();

        return view('admin.showproduct', compact('data'));
    }

    public function deleteproduct($id)
    {
        $data=product::find($id);
        $data->delete();

        return redirect()->back()->with('message', 'Product deleted successfully');
        ;
    }

    public function updateview($id)
    {
        $data=product::find($id);

        return view('admin.updateview', compact('data'));
    }

    public function updateproduct(Request $request, $id)
    {
        $data=product::find($id);

        $image=$request->file;

            if($image)
            {

        $imagename=time().'.'.$image->getClientOriginalExtension();

        $request->file->move('productimage',$imagename);

        $data->image=$imagename;
            }

        $data->title=$request->title;
        $data->price=$request->price;
        $data->description=$request->des;
        $data->quantity=$request->quantity;
   
        $data->save();

        return redirect()->back()->with('message', 'Product updated successfully');

    }
}
