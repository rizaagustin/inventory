<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;
use App\Models\ProductIn;
use App\Models\ProductInDetail;
use App\Models\ProductOutDetail;
use App\Models\ProductOut;
use App\Models\User;
class HomeController extends Controller
{
    public function index(){
        $product = product::count();
        $productin = ProductIn::count();
        $productout = ProductOut::count();
        $user = User::count();
        $productindetails = ProductInDetail::latest()->take(12)->get();
        $productoutdetails = ProductOutDetail::latest()->take(12)->get();
        return view('pages.home', compact('product', 'productin', 'productout', 'user','productindetails', 'productoutdetails'));
    }
}
