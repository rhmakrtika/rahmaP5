<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
    use HasFactory;
    protected $fillable = ['tanggal_reservasi', 'jumlah_orang','id_pengunjung','id_destinasi'];
    protected $visible = ['tanggal_reservasi', 'jumlah_orang','id_pengunjung','id_destinasi'];

    public function pengunjung()
    {
        return $this->belongsTo(Pengunjung::class, 'id_pengunjung');
    }

    public function destinasi()
    {
        return $this->belongsTo(Destinasi::class, 'id_destinasi');
    }
    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'id_reservasi');
    }
}
