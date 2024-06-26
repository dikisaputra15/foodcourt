<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_warung',
        'id_kategori',
        'nama_produk',
        'stok',
        'harga',
        'deskripsi_produk',
        'path_gambar',
    ];
}
