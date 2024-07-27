<?php

namespace App\Http\Controllers;

use App\Models\Ketua;
use App\Models\Prestasi;
use App\Models\Kehadiran;
use Illuminate\Http\Request;
use App\Models\ProgramKegiatan;
use App\Models\JadwalEkstrakurikuler;

class LaporanController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $ketua = Ketua::all();
        $prestasi = Prestasi::all();
        $kehadiran = Kehadiran::all();
        $programKegiatan = ProgramKegiatan::all();
        $jadwalEkstrakurikuler = JadwalEkstrakurikuler::with('ekstrakurikuler')->get();

        return view('laporan.index', compact('prestasi', 'kehadiran', 'programKegiatan', 'jadwalEkstrakurikuler'));
    }
}
