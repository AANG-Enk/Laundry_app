<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Layanan;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    public function index()
    {
        return response()->json(
            Pesanan::with(['layanan', 'pelanggan', 'user'])->get()
        );
    }

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

    public function show(Pesanan $pesanan)
    {
        return response()->json(
            $pesanan->load(['layanan', 'pelanggan', 'user'])
        );
    }

    public function update(Request $request, Pesanan $pesanan)
    {
        // FIX: sebelumnya "exists:layanans,id_layanan" dan "exists:pelanggans,id_pelanggan"
        // — kolom itu tidak ada di tabel layanans/pelanggans (PK-nya cuma "id"), jadi validasi
        // selalu gagal setiap kali id_layanan/id_pelanggan dikirim saat update.
        $validated = $request->validate([
            'id_layanan'       => 'sometimes|required|exists:layanans,id',
            'id_pelanggan'     => 'sometimes|required|exists:pelanggans,id',
            'berat_kg'         => 'nullable|numeric|min:0',
            'jumlah_item'      => 'nullable|integer|min:0',
            'tanggal_masuk'    => 'sometimes|required|date',
            'estimasi_selesai' => 'sometimes|required|date|after_or_equal:tanggal_masuk',
            'status'           => 'sometimes|required|in:diterima,proses_cuci,proses_setrika,siap_diambil,selesai,dibatalkan',
            'catatan'          => 'nullable|string',
        ]);

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

    public function destroy(Pesanan $pesanan)
    {
        $pesanan->delete();

        return response()->json(
            ['message' => 'Pesanan berhasil dihapus'],
            200
        );
    }
}
