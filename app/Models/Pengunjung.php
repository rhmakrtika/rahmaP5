<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengunjung extends Model
{
    use HasFactory;
    protected $fillable = ['nama', 'no_telepon','alamat'];
    protected $visible = ['nama', 'no_telepon','alamat'];

    public function reservasi()
    {
        return $this->hasMany(Reservasi::class, 'id_pengunjung');
    }
}
