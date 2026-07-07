<?php

namespace App\Imports;

use App\Models\Layanan;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class LayananImport implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row)
    {
        return new Layanan([
            'nama_layanan' => $row['nama_layanan'],
            'kategori'     => $row['kategori'],
            'harga'        => $row['harga'],
            'satuan'       => $row['satuan'],
            'estimasi_jam' => $row['estimasi_jam'],
        ]);
    }

    // Validasi per baris supaya tidak ada data rusak yang lolos ke database
    // (mis. kategori/satuan di luar enum, atau harga bukan angka)
    public function rules(): array
    {
        return [
            'nama_layanan'  => 'required|string|max:255',
            'kategori'      => 'required|in:kiloan,setrika_express,dry_cleaning',
            'harga'         => 'required|numeric|min:0',
            'satuan'        => 'required|in:kg,item',
            'estimasi_jam'  => 'required|integer|min:1',
        ];
    }
}
