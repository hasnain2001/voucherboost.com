<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stores;
use App\Models\Coupons;
use App\Models\Networks;
use App\Models\Blog;
use App\Models\Categories;
class EmployeeController extends Controller
{
    public function dashboard()
    {
       $stores =Stores::all();
       $coupons =Coupons::all();
       $blogs =Blog::all();
       $categories =Categories::all();
       $networks =Networks::all();
        return view('employee.dashboard',compact('stores','coupons','blogs','categories','networks'));
    }
}
