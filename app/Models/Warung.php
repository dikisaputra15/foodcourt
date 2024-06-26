<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warung extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_warung',
        'deskripsi_warung',
        'gambar_warung',
    ];
}
