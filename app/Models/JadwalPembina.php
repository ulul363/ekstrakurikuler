<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalPembina extends Model
{
    use HasFactory;

    protected $table = 'jadwal_pembina';
    protected $primaryKey = 'id_jadwal_pembina';

    protected $fillable = [
        'pembina_id',
        'hari',
        'waktu_mulai',
        'waktu_selesai',
        'status'
    ];

    public function jadwalpembina()
    {
        return $this->belongsTo(Pembina::class, 'pembina_id', 'id_pembina');
    }
}
