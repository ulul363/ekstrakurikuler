<?php

namespace App\Models;

use App\Models\Pembina;
use App\Models\Kehadiran;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ekstrakurikuler extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_ekstrakurikuler';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_ekstrakurikuler',
        'nip_pembina',
        'nama_ekstrakurikuler',
        'nama',
    ];

    public function pembina()
    {
        return $this->belongsTo(Pembina::class, 'nip_pembina', 'nip_pembina');
    }

    public function kehadiran()
    {
        return $this->hasMany(Kehadiran::class, 'ekstrakurikuler_id', 'id_ekstrakurikuler');
    }

}