<?php

namespace App\Http\Controllers\Admin;

use App\Models\Support;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SupportController extends Controller
{
    public function index(Support $support)
    {
        $supports = $support->all();

        return view('admin/supports/index', compact('supports'));
    }

    public function create()
    {
        return view('admin/supports/create');
    }

    public function store(Request $request, Support $support)
    {
       $data = $request->all(); 
       $data['status'] = 'a';

        $support->create($data);

       return redirect()->route('supports.index');
    }

    public function show(string|int $id)
    {
        if(!$support = Support::find($id))
        {
            return redirect()->back();
        }
        return view('admin/supports/show', compact('$support'));
    }
}