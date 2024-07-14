<?php

namespace App\Models;

use App\Models\Ketua;
use App\Models\Pembina;
use App\Models\PengajuanPertemuan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Chat extends Model
{
    use HasFactory;

    protected $table = 'chat';
    protected $primaryKey = 'id_chat';

    protected $fillable = [
        'ketua_id',
        'pembina_id',
        'tanggal',
        'pesan',
        'pengajuan_pertemuan_id'
    ];

    public function ketua()
    {
        return $this->belongsTo(Ketua::class, 'ketua_id', 'id_ketua');
    }

    public function pembina()
    {
        return $this->belongsTo(Pembina::class, 'pembina_id', 'id_pembina');
    }

    public function pengajuanPertemuan()
    {
        return $this->belongsTo(PengajuanPertemuan::class, 'pengajuan_pertemuan_id', 'id_pengajuan_pertemuan');
    }
}