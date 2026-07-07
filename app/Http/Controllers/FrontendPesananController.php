<?php

namespace App\Http\Controllers;

use App\Exports\PesananExport;
use App\Models\Pesanan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

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

    public function exportExcel(Request $request)
    {
        if (!session('login')) {
            return redirect('/login');
        }

        $request->validate(['bulan' => 'required|numeric|between:1,12']);

        return Excel::download(
            new PesananExport($request->bulan),
            'laporan-pesanan.xlsx'
        );
    }

    public function exportPdf(Request $request)
    {
        if (!session('login')) {
            return redirect('/login');
        }

        $request->validate(['bulan' => 'required|numeric|between:1,12']);

        $bulan = $request->bulan;

        $pesanans = Pesanan::with('layanan', 'pelanggan', 'user')
            ->whereMonth('tanggal_masuk', $bulan)
            ->get();

        $diterima      = $pesanans->where('status', 'diterima')->count();
        $prosesCuci    = $pesanans->where('status', 'proses_cuci')->count();
        $prosesSetrika = $pesanans->where('status', 'proses_setrika')->count();
        $siapDiambil   = $pesanans->where('status', 'siap_diambil')->count();
        $selesai       = $pesanans->where('status', 'selesai')->count();
        $dibatalkan    = $pesanans->where('status', 'dibatalkan')->count();

        $totalOmzet = $pesanans->where('status', 'selesai')->sum('total_harga');

        $pdf = Pdf::loadView('pesanan.report', compact(
            'pesanans',
            'bulan',
            'diterima',
            'prosesCuci',
            'prosesSetrika',
            'siapDiambil',
            'selesai',
            'dibatalkan',
            'totalOmzet'
        ));

        return $pdf->download('laporan-pesanan.pdf');
    }
}
