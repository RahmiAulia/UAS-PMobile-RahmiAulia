<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produks';

    protected $primaryKey = 'id_produk';

    protected $fillable = [
        'id_kategori',
        'nama_produk',
        'harga',
        'stok',
        'deskripsi',
        'gambar_produk',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori_produk::class, 'id_kategori');
    }

    public function ulasan()
    {
        return $this->hasMany(Ulasan::class, 'id_produk');
    }

    public function detailKeranjang()
    {
        return $this->hasMany(Detail_keranjang::class, 'id_produk');
    }

    public function detailTransaksi()
    {
        return $this->hasMany(Detail_transaksi::class, 'id_produk');
    }
}
