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
        dd($supports);


        return view('admin/supports/index', compact('supports'));
    }

    public function create()
    {
        return view('admin/supports/create');
    }

    public function store(Request $request)
    {
       dd($request); 
    }
}