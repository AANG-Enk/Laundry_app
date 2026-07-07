<?php

namespace App\Exports;

use App\Models\Pesanan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PesananExport implements FromCollection, WithHeadings
{
    protected string $bulan;

    public function __construct(string $bulan)
    {
        $this->bulan = $bulan;
    }

    public function collection()
    {
        return Pesanan::with('layanan', 'pelanggan', 'user')
            ->whereMonth('tanggal_masuk', $this->bulan)
            ->get()
            ->map(function ($pesanan) {
                return [
                    $pesanan->id,
                    $pesanan->pelanggan->nama ?? '-',
                    $pesanan->layanan->nama_layanan ?? '-',
                    $pesanan->berat_kg,
                    $pesanan->jumlah_item,
                    $pesanan->total_harga,
                    $pesanan->tanggal_masuk,
                    $pesanan->estimasi_selesai,
                    $pesanan->status,
                    $pesanan->user->name ?? '-',
                    $pesanan->catatan,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'ID Pesanan',
            'Nama Pelanggan',
            'Layanan',
            'Berat (kg)',
            'Jumlah Item',
            'Total Harga',
            'Tanggal Masuk',
            'Estimasi Selesai',
            'Status',
            'Petugas',
            'Catatan',
        ];
    }
}
