<?php

namespace App\Http\Controllers;

use App\Imports\LayananImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException;

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

    public function import(Request $request)
    {
        if (!session('login')) {
            return redirect('/login');
        }

        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:2048',
        ]);

        try {
            Excel::import(new LayananImport, $request->file('file'));
        } catch (ValidationException $e) {
            // WithValidation di LayananImport menolak baris yang datanya tidak valid
            // (mis. kategori/satuan salah, harga bukan angka) -- tampilkan pesannya ke user
            $failures = $e->failures();
            $pesan = collect($failures)->map(function ($failure) {
                return 'Baris ' . $failure->row() . ': ' . implode(', ', $failure->errors());
            })->implode(' | ');

            return redirect('/layanan')->with('error', 'Import gagal - ' . $pesan);
        }

        return redirect('/layanan')->with('success', 'Data layanan berhasil diimport');
    }
}
