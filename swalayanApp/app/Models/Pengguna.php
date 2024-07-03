<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengguna extends Model
{
    use HasFactory;

    protected $table = 'penggunas';

    protected $primaryKey = 'id_pengguna';

    protected $fillable = [
        'nama',
        'email',
        'password',
        'alamat',
        'no_telepon',
    ];

    public function keranjang()
    {
        return $this->hasMany(Keranjang::class, 'id_pengguna');
    }

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'id_pengguna');
    }

    public function ulasan()
    {
        return $this->hasMany(Ulasan::class, 'id_pengguna');
    }
}
