<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $fillable = ['metode_pembayaran', 'jumlah_pembayaran', 'tanggal_transaksi','id_reservasi'];
    protected $visible = ['metode_pembayaran', 'jumlah_pembayaran', 'tanggal_transaksi','id_reservasi'];

    public function reservasi()
    {
        return $this->belongsTo(Reservasi::class, 'id_reservasi');
    }
}
