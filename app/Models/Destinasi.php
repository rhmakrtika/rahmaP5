<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destinasi extends Model
{
    use HasFactory;
    protected $fillable = ['nama_destinasi', 'lokasi', 'deskripsi', 'image'];
    protected $visible = ['nama_destinasi', 'lokasi', 'deskripsi', 'image'];

    public function reservasi()
    {
        return $this->hasMany(Reservasi::class, 'id_destinasi');
    }
}
