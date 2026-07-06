<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Layanan;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(
            Pesanan::with(['layanan', 'pelanggan', 'user'])->get()
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_layanan'       => 'required|exists:layanans,id',
            'id_pelanggan'     => 'required|exists:pelanggans,id',
            'id_user'          => 'required|exists:users,id',
            'berat_kg'         => 'nullable|numeric|min:0',
            'jumlah_item'      => 'nullable|integer|min:0',
            'tanggal_masuk'    => 'required|date',
            'estimasi_selesai' => 'required|date|after_or_equal:tanggal_masuk',
            'status'           => 'nullable|in:diterima,proses_cuci,proses_setrika,siap_diambil,selesai,dibatalkan',
            'catatan'          => 'nullable|string',
        ]);

        // Hitung total harga otomatis berdasarkan harga layanan (per kg atau per item)
        $layanan = Layanan::findOrFail($validated['id_layanan']);
        $qty = $layanan->satuan === 'kg'
            ? ($validated['berat_kg'] ?? 0)
            : ($validated['jumlah_item'] ?? 0);
        $validated['total_harga'] = $layanan->harga * $qty;
        $validated['status'] = $validated['status'] ?? 'diterima';

        $pesanan = Pesanan::create($validated);

        return response()->json(
            $pesanan->load(['layanan', 'pelanggan', 'user']),
            201
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Pesanan $pesanan)
    {
        return response()->json(
            $pesanan->load(['layanan', 'pelanggan', 'user'])
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pesanan $pesanan)
    {
        $validated = $request->validate([
            'id_layanan'       => 'sometimes|required|exists:layanans,id_layanan',
            'id_pelanggan'     => 'sometimes|required|exists:pelanggans,id_pelanggan',
            'berat_kg'         => 'nullable|numeric|min:0',
            'jumlah_item'      => 'nullable|integer|min:0',
            'tanggal_masuk'    => 'sometimes|required|date',
            'estimasi_selesai' => 'sometimes|required|date|after_or_equal:tanggal_masuk',
            'status'           => 'sometimes|required|in:diterima,proses_cuci,proses_setrika,siap_diambil,selesai,dibatalkan',
            'catatan'          => 'nullable|string',
        ]);

        // Hitung ulang total harga jika layanan/qty berubah
        if (isset($validated['id_layanan']) || array_key_exists('berat_kg', $validated) || array_key_exists('jumlah_item', $validated)) {
            $layanan = Layanan::findOrFail($validated['id_layanan'] ?? $pesanan->id_layanan);
            $qty = $layanan->satuan === 'kg'
                ? ($validated['berat_kg'] ?? $pesanan->berat_kg ?? 0)
                : ($validated['jumlah_item'] ?? $pesanan->jumlah_item ?? 0);
            $validated['total_harga'] = $layanan->harga * $qty;
        }

        $pesanan->update($validated);

        return response()->json(
            $pesanan->load(['layanan', 'pelanggan', 'user'])
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pesanan $pesanan)
    {
        $pesanan->delete();

        return response()->json(
            ['message' => 'Pesanan berhasil dihapus'],
            200
        );
    }
}
