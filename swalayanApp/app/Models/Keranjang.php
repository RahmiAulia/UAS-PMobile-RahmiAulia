<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    use HasFactory;

    protected $table = 'keranjangs';

    protected $primaryKey = 'id_keranjang';

    protected $fillable = [
        'id_pengguna',
    ];

    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'id_pengguna');
    }

    public function detailKeranjang()
    {
        return $this->hasMany(Detail_keranjang::class, 'id_keranjang');
    }
}
