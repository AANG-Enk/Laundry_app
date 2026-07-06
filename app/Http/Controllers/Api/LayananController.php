<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Layanan;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(
            Layanan::all()
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_layanan'  => 'required|string|max:255',
            'kategori'      => 'required|in:kiloan,setrika_express,dry_cleaning',
            'harga'         => 'required|numeric|min:0',
            'satuan'        => 'required|in:kg,item',
            'estimasi_jam'  => 'nullable|integer|min:1',
        ]);

        $layanan = Layanan::create($validated);

        return response()->json(
            $layanan,
            201
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Layanan $layanan)
    {
        return response()->json($layanan);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Layanan $layanan)
    {
        $validated = $request->validate([
            'nama_layanan'  => 'sometimes|required|string|max:255',
            'kategori'      => 'sometimes|required|in:kiloan,setrika_express,dry_cleaning',
            'harga'         => 'sometimes|required|numeric|min:0',
            'satuan'        => 'sometimes|required|in:kg,item',
            'estimasi_jam'  => 'nullable|integer|min:1',
        ]);

        $layanan->update($validated);

        return response()->json($layanan);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Layanan $layanan)
    {
        $layanan->delete();

        return response()->json(
            ['message' => 'Layanan berhasil dihapus'],
            200
        );
    }
}
