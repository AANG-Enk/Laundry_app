<?php

namespace App\Http\Controllers;

class FrontendLayananController extends Controller
{
    public function index()
    {
        if (!session('login')) {
            return redirect('/login');
        }
        return view('layanan.index');
    }

    public function create()
    {
        if (!session('login')) {
            return redirect('/login');
        }
        return view('layanan.create');
    }

    public function edit($id)
    {
        if (!session('login')) {
            return redirect('/login');
        }
        return view('layanan.edit', compact('id'));
    }
}
