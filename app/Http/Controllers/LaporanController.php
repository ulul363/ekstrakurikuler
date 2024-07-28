<?php

namespace App\Http\Controllers;

use App\Models\Prestasi;
use App\Models\Kehadiran;
use Illuminate\Http\Request;
use App\Models\ProgramKegiatan;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\JadwalEkstrakurikuler;

class LaporanController extends Controller
{
    public function index()
    {
        $programKegiatan = ProgramKegiatan::with('ekstrakurikuler', 'ketua', 'pembina')->get();
        $kehadiran = Kehadiran::with('ekstrakurikuler', 'ketua', 'pembina')->get();
        $prestasi = Prestasi::with('ekstrakurikuler', 'ketua', 'pembina')->get();
        $jadwalEkstrakurikuler = JadwalEkstrakurikuler::with('ekstrakurikuler')->get();

        return view('laporan.index', compact('programKegiatan', 'kehadiran', 'prestasi', 'jadwalEkstrakurikuler'));
    }

    public function exportPDF(Request $request)
    {
        $type = $request->input('type'); // 'program_kegiatan', 'kehadiran', 'prestasi'
        $ekstrakurikuler_id = $request->input('ekstrakurikuler_id');
        $tahun_ajaran = $request->input('tahun_ajaran');

        if ($type == 'program_kegiatan') {
            $data = ProgramKegiatan::where('ekstrakurikuler_id', $ekstrakurikuler_id)->where('tahun_ajaran', $tahun_ajaran)->with('ekstrakurikuler', 'ketua', 'pembina')->get();
            $pdf = PDF::loadView('laporan.pdf.program_kegiatan', compact('data'));
        } elseif ($type == 'kehadiran') {
            $data = Kehadiran::where('ekstrakurikuler_id', $ekstrakurikuler_id)->where('tahun_ajaran', $tahun_ajaran)->with('ekstrakurikuler', 'ketua', 'pembina')->get();
            $pdf = PDF::loadView('laporan.pdf.kehadiran', compact('data'));
        } elseif ($type == 'prestasi') {
            $data = Prestasi::where('ekstrakurikuler_id', $ekstrakurikuler_id)->where('tahun_ajaran', $tahun_ajaran)->with('ekstrakurikuler', 'ketua', 'pembina')->get();
            $pdf = PDF::loadView('laporan.pdf.prestasi', compact('data'));
        }

        return $pdf->download('laporan.pdf');
    }
}
