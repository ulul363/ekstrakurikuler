<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembina extends Model
{
    use HasFactory;

    protected $table = 'pembina';

    protected $primaryKey = 'nip_pembina';
    public $incrementing = false;

    protected $fillable = [
        'nip_pembina',
        'nama',
        'email',
        'no_hp',
        'alamat',
        'jenis_kelamin'
    ];
}
