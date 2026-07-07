<!DOCTYPE html>
<html>
<head>
    <title>Laporan Pesanan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #14213A;
            font-size: 13px;
        }
        h2 {
            color: #0D3B4E;
            margin-bottom: 4px;
        }
        .subtitle {
            color: #4B5B66;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 24px;
        }
        table, th, td {
            border: 1px solid #cfd6d9;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #0D3B4E;
            color: #ffffff;
        }
        .ringkasan td:first-child {
            font-weight: bold;
        }
        .total-row td {
            background-color: #F5F7F8;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h2>Laporan Pesanan — Bersih Kilat Laundry</h2>
    <p class="subtitle">Periode Bulan: {{ $bulan }}</p>

    <table class="ringkasan">
        <tr>
            <th>Keterangan</th>
            <th>Jumlah</th>
        </tr>
        <tr>
            <td>Diterima</td>
            <td>{{ $diterima }}</td>
        </tr>
        <tr>
            <td>Proses Cuci</td>
            <td>{{ $prosesCuci }}</td>
        </tr>
        <tr>
            <td>Proses Setrika</td>
            <td>{{ $prosesSetrika }}</td>
        </tr>
        <tr>
            <td>Siap Diambil</td>
            <td>{{ $siapDiambil }}</td>
        </tr>
        <tr>
            <td>Selesai</td>
            <td>{{ $selesai }}</td>
        </tr>
        <tr>
            <td>Dibatalkan</td>
            <td>{{ $dibatalkan }}</td>
        </tr>
        <tr class="total-row">
            <td>Total Omzet (status Selesai)</td>
            <td>Rp {{ number_format($totalOmzet, 0, ',', '.') }}</td>
        </tr>
    </table>

    <table>
        <tr>
            <th>No</th>
            <th>Pelanggan</th>
            <th>Layanan</th>
            <th>Tanggal Masuk</th>
            <th>Status</th>
            <th>Total</th>
        </tr>
        @forelse ($pesanans as $index => $pesanan)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $pesanan->pelanggan->nama ?? '-' }}</td>
            <td>{{ $pesanan->layanan->nama_layanan ?? '-' }}</td>
            <td>{{ $pesanan->tanggal_masuk }}</td>
            <td>{{ str_replace('_', ' ', $pesanan->status) }}</td>
            <td>Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="6" style="text-align:center;">Tidak ada data pesanan pada bulan ini</td>
        </tr>
        @endforelse
    </table>
</body>
</html>
