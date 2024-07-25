<?php

namespace App\Http\Controllers;

use App\Models\Prestasi;
// use Barryvdh\DomPDF\PDF;
// use Barryvdh\DomPDF\PDF;
use App\Models\Kehadiran;
use Illuminate\Http\Request;
use App\Models\Ekstrakurikuler;
// use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\ProgramKegiatan;
use Illuminate\Support\Facades\Log;

class LaporanController extends Controller
{
    public function index()
    {
        $ekstrakurikulers = Ekstrakurikuler::all();

        return view('laporan.index', compact('ekstrakurikulers'));
    }

    public function generatePDF(Request $request)
    {
        try {
            $request->validate([
                'ekstrakurikuler' => 'required|exists:ekstrakurikulers,id',
                'tahun_ajaran' => 'required|integer',
            ], [
                'ekstrakurikuler.exists' => 'Ekstrakurikuler tidak valid.',
                'tahun_ajaran.integer' => 'Tahun ajaran harus berupa angka.',
            ]);

            $ekstrakurikulerId = $request->input('ekstrakurikuler');
            $tahunAjaran = $request->input('tahun_ajaran');

            $programKegiatan = ProgramKegiatan::where('ekstrakurikuler_id', $ekstrakurikulerId)
                ->where('tahun_ajaran', $tahunAjaran)
                ->get();

            if ($programKegiatan->isEmpty()) {
                return redirect()->back()->with('error', 'Maaf, data untuk ekstrakurikuler dan tahun ajaran ini tidak ditemukan.');
            }

            $prestasiSiswa = Prestasi::where('ekstrakurikuler_id', $ekstrakurikulerId)
                ->where('tahun_ajaran', $tahunAjaran)
                ->get();

            if ($prestasiSiswa->isEmpty()) {
                return redirect()->back()->with('error', 'Maaf, data prestasi siswa untuk ekstrakurikuler dan tahun ajaran ini tidak ditemukan.');
            }

            $data = [
                'programKegiatan' => $programKegiatan,
                'prestasiSiswa' => $prestasiSiswa,
            ];

            $pdf = PDF::loadView('laporan.pdf', $data);

            return $pdf->download('laporan.pdf');

        } catch (\Exception $e) {
            Log::error('Error generating PDF: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghasilkan PDF.');
        }
    }
}
