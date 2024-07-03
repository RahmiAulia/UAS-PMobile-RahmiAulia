<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori_pembayaran extends Model
{
    use HasFactory;

    protected $table = 'kategori_pembayarans';

    protected $primaryKey = 'id_kategori_pembayaran';

    protected $fillable = [
        'jenis_pembayaran',
    ];

    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class, 'id_kategori_pembayaran');
    }
}
