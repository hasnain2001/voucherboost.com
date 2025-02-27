<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\DeleteBlogs;
use App\Models\DeleteCoupons;
use App\Models\DeleteStore;
use Illuminate\Http\Request;

class DeleteController extends Controller
{

    public function deletedStores()
   {
       $deletedStores = DeleteStore::with('deletedBy')->orderBy('created_at','desc')->get();
       return view('admin.deleted.delete_stores', compact('deletedStores'));
   }
    public function delete($id) {
        DeleteStore::find($id)->delete();
        return redirect()->back()->with('success', ' Deleted Successfully');
    }

    public function Coupon()
    {
        $deletedcoupons = DeleteCoupons::with('deletedBy')->orderBy('created_at','desc')->get();
        return view('admin.deleted.coupons', compact('deletedcoupons'));
    }
    public function delete_coupon($id) {
        DeleteCoupons::find($id)->delete();
        return redirect()->back()->with('success', ' Deleted Successfully');
    }
    public function blog()
    {
        $blogs = DeleteBlogs::with('deletedBy')->orderBy('created_at','desc')->get();
        return view('admin.deleted.blog', compact('blogs'));
    }

    public function delete_blog($id) {
        DeleteBlogs::find($id)->delete();
        return redirect()->back()->with('success', ' Deleted Successfully');
    }

}
