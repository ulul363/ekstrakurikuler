<?php

namespace App\Http\Controllers;

use App\Models\Prestasi;
use App\Models\Kehadiran;
use Illuminate\Http\Request;
use App\Models\ProgramKegiatan;
// use Barryvdh\DomPDF\PDF;
use Barryvdh\DomPDF\Facade\Pdf;
// use Barryvdh\DomPDF\Facade as PDF;

// use Barryvdh\DomPDF\PDF as DomPDFPDF;

// use Barryvdh\DomPDF\PDF as DomPDFPDF;

class LaporanController extends Controller
{
    public function index()
    {
        return view('laporan.index');
    }

    public function generatePDF(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'tahun_ajaran' => 'required|integer',
        ], [
            'tahun_ajaran.integer' => 'Tahun ajaran harus berupa angka.',
        ]);

        $tahunAjaran = $request->input('tahun_ajaran');

        // $kehadiran = Kehadiran::where('tahun_ajaran', $tahunAjaran)->get();
        $programKegiatan = ProgramKegiatan::where('tahun_ajaran', $tahunAjaran)->get();
        $prestasiSiswa = Prestasi::where('tahun_ajaran', $tahunAjaran)->get();
        // dd($prestasiSiswa);

        if ($programKegiatan->isEmpty() && $prestasiSiswa->isEmpty()) {
            return redirect()->back()->with('error', 'Maaf, data untuk tahun ajaran ini tidak ditemukan.');
        }

        $data = [
            // 'kehadiran' => $kehadiran,
            'programKegiatan' => $programKegiatan,
            'prestasiSiswa' => $prestasiSiswa,
        ];
        $pdf = PDF::loadView('laporan.pdf', $data);

        // Optional: Set paper size (default is A4)
        // $pdf->setPaper('A4', 'landscape');

        // Download the PDF file
        return $pdf->download('laporan.pdf');
    }
}
