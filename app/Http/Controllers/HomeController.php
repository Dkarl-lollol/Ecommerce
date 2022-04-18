<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function redirect()
    {
        $usertype=Auth::user()->usertype;

        if ($usertype=='1')
        {
            return view('admin.home');
        }

        else
        {
            $data = Product::paginate(2);

            return view('user.home',compact('data'));
        }
    }

    public function index()
    {
        if(Auth::id())

        {
            return redirect('redirect');
        }

        else
        {

          $data = Product::paginate(2);

          return view('user.home',compact('data'));
        }
    }

    public function search(Request $request)
    {
        $search=$request->search;

        if($search=='')

        {
            $data = Product::paginate(2);

            return view('user.home',compact('data'));
        }

        $data=product::where('title', 'Like', '%'.$search.'%')->get();

        return view ('user.home',compact('data'));
    }

    public function addcart(Request $request, $id)
    {
        if(Auth::id())
        {
            return redirect()->back;
        }

        else
        {
            return redirect('login');
        }
    }
}
