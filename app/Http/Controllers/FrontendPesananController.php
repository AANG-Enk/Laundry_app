<?php

namespace App\Http\Controllers;

class FrontendPesananController extends Controller
{
    public function index()
    {
        if (!session('login')) {
            return redirect('/login');
        }
        return view('pesanan.index');
    }

    public function create()
    {
        if (!session('login')) {
            return redirect('/login');
        }
        return view('pesanan.create');
    }

    public function edit($id)
    {
        if (!session('login')) {
            return redirect('/login');
        }
        return view('pesanan.edit', compact('id'));
    }
}
