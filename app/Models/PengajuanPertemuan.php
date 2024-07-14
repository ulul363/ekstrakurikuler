<?php

namespace App\Models;

use App\Models\Ketua;
use App\Models\Pembina;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PengajuanPertemuan extends Model
{
    use HasFactory;

    protected $table = 'pengajuan_pertemuan';
    protected $primaryKey = 'id_pengajuan_pertemuan';

    protected $fillable = [
        'ketua_id',
        'pembina_id',
        'tanggal',
        'waktu',
        'status'
    ];

    public function ketua()
    {
        return $this->belongsTo(Ketua::class, 'ketua_id', 'id_ketua');
    }

    public function pembina()
    {
        return $this->belongsTo(Pembina::class, 'pembina_id', 'id_pembina');
    }
}