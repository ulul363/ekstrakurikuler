<?php

namespace App\Models;

use App\Models\User;
use App\Models\Kehadiran;
use App\Models\Ekstrakurikuler;
use App\Models\ProgramKegiatan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ketua extends Model
{
    use HasFactory;

    protected $table = 'ketua';
    protected $primaryKey = 'id_ketua';

    protected $fillable = ['user_id', 'ekstrakurikuler_id', 'nis', 'nama', 'alamat', 'jk', 'no_hp'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function ekstrakurikuler()
    {
        return $this->belongsTo(Ekstrakurikuler::class, 'ekstrakurikuler_id', 'id_ekstrakurikuler');
    }

    public function kehadiran()
    {
        return $this->hasMany(Kehadiran::class, 'ekstrakurikuler_id', 'id_ekstrakurikuler');
    }

    public function programKegiatan()
    {
        return $this->hasMany(ProgramKegiatan::class, 'verifikasi_id', 'id_pembina');
    }
}