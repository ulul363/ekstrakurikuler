<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    
}
