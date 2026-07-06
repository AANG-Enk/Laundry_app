<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_layanan',
        'kategori',
        'harga',
        'satuan',
        'estimasi_jam',
    ];

    // Satu layanan bisa dipesan berkali-kali (mis. beberapa pesanan Cuci Kiloan)
    public function pesanans()
    {
        return $this->hasMany(
            Pesanan::class,
            'id_layanan',
            'id'
        );
    }
}
