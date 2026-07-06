<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(
            Pelanggan::all()
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'   => 'required|string|max:255',
            'no_hp'  => 'required|string|max:20',
            'email'  => 'nullable|email|max:255',
            'alamat' => 'required|string',
        ]);

        $pelanggan = Pelanggan::create($validated);

        return response()->json(
            $pelanggan,
            201
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Pelanggan $pelanggan)
    {
        return response()->json($pelanggan);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pelanggan $pelanggan)
    {
        $validated = $request->validate([
            'nama'   => 'sometimes|required|string|max:255',
            'no_hp'  => 'sometimes|required|string|max:20',
            'email'  => 'nullable|email|max:255',
            'alamat' => 'sometimes|required|string',
        ]);

        $pelanggan->update($validated);

        return response()->json($pelanggan);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pelanggan $pelanggan)
    {
        $pelanggan->delete();

        return response()->json(
            ['message' => 'Pelanggan berhasil dihapus'],
            200
        );
    }
}
