<?php

namespace App\Http\Controllers;

class FrontendPelangganController extends Controller
{
    public function index()
    {
        if (!session('login')) {
            return redirect('/login');
        }
        return view('pelanggan.index');
    }

    public function create()
    {
        if (!session('login')) {
            return redirect('/login');
        }
        return view('pelanggan.create');
    }

    public function edit($id)
    {
        if (!session('login')) {
            return redirect('/login');
        }
        return view('pelanggan.edit', compact('id'));
    }
}
