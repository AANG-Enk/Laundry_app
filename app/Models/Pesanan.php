<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_layanan',
        'id_pelanggan',
        'id_user',
        'berat_kg',
        'jumlah_item',
        'total_harga',
        'tanggal_masuk',
        'estimasi_selesai',
        'status',
        'catatan',
    ];

    // Satu pesanan menggunakan satu jenis layanan
    public function layanan()
    {
        return $this->belongsTo(Layanan::class,'id_layanan','id');
    }

    // Satu pesanan dibuat oleh satu pelanggan
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class,'id_pelanggan','id');
    }

    // Satu pesanan dicatat oleh satu petugas (user)
    public function user()
    {
        return $this->belongsTo(User::class,'id_user','id');
    }
}
