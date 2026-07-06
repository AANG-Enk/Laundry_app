<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'no_hp',
        'email',
        'alamat',
    ];

    // Satu pelanggan dapat melakukan banyak pesanan laundry
    public function pesanans()
    {
        return $this->hasMany(
            Pesanan::class,
            'id_pelanggan',
            'id'
        );
    }
}
