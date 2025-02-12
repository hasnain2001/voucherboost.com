<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Networks;
use Illuminate\Http\Request;

class NetworksController extends Controller
{
    public function network() {
        $networks = Networks::all();
        return view('admin.networks.index', compact('networks'));
    }

    public function create_network() {
        return view('admin.networks.create');
    }

    public function store_network(Request $request) {

        Networks::create([
            'title' => $request->title,
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Network Created Successfully');
    }

    public function edit_network($id) {
        $networks = Networks::find($id);
        return view('admin.networks.edit', compact('networks'));
    }

    public function update_network(Request $request, $id) {
        $networks = Networks::find($id);

        $networks->update([
            'title' => $request->title,
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Network Updated Successfully');
    }

    public function delete_network($id) {
        Networks::find($id)->delete();
        return redirect()->back()->with('success', 'Network Deleted Successfully');
    }
}
