<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayarans';

    protected $primaryKey = 'id_pembayaran';

    protected $fillable = [
        'id_kategori_pembayaran',
        'total_pembayaran',
        'tanggal_pembayaran'
    ];

    public function kategoriPembayaran()
    {
        return $this->belongsTo(Kategori_pembayaran::class, 'id_kategori_pembayaran');
    }

    public function shipping()
    {
        return $this->belongsTo(Shipping::class, 'id_pembayaran', 'id_pembayaran');
    }
}

