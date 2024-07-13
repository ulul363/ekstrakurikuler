<?php

namespace App\Models;

use App\Models\User;
use App\Models\Ekstrakurikuler;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pembina extends Model
{
    use HasFactory;

    protected $table = 'pembina';
    protected $primaryKey = 'id_pembina';

    protected $fillable = [
        'user_id',
        'ekstrakurikuler_id',
        'nip',
        'nama',
        'alamat',
        'jk',
        'no_hp',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ekstrakurikuler()
    {
        return $this->belongsTo(Ekstrakurikuler::class);
    }
}