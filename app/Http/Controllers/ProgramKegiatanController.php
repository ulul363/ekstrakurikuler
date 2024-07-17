<?php

namespace App\Http\Controllers;

use App\Models\ProgramKegiatan;
use App\Models\Ekstrakurikuler;
use App\Models\Ketua;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProgramKegiatanController extends Controller
{
    public function index()
    {
        // Ambil id_ketua dari pengguna yang sedang login
        $ketuaId = Auth::user()->ketua->id_ketua;

        // Dapatkan program kegiatan yang hanya berhubungan dengan ketua yang sedang login
        $programKegiatan = ProgramKegiatan::with('ekstrakurikuler', 'ketua', 'pembina')->where('ketua_id', $ketuaId)->get();

        // dd($programKegiatan);

        return view('program_kegiatan.index', compact('programKegiatan'));
    }

    public function create()
    {
        $ekstrakurikuler = Ekstrakurikuler::all();
        return view('program_kegiatan.create', compact('ekstrakurikuler'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_program' => 'required|string|max:50',
            'tahun_ajaran' => 'required|string|max:11',
            'deskripsi' => 'required|string|max:50',
        ]);

        // Pastikan pengguna yang login memiliki data ketua
        if (Auth::user()->ketua) {
            $ekstrakurikuler_id = Auth::user()->ketua->ekstrakurikuler_id;
            $ketua_id = Auth::user()->ketua->id_ketua;

            ProgramKegiatan::create([
                'ekstrakurikuler_id' => $ekstrakurikuler_id,
                'ketua_id' => $ketua_id,
                'nama_program' => $request->nama_program,
                'tahun_ajaran' => $request->tahun_ajaran,
                'deskripsi' => $request->deskripsi,
                'status' => 'pending', // atau biarkan default di database
            ]);

            return redirect()->route('program_kegiatan.index')->with('success', 'Program Kegiatan berhasil diajukan.');
        } else {
            return redirect()->route('program_kegiatan.create')->withErrors('Pengguna yang login tidak memiliki data ketua yang valid.');
        }
    }

    public function edit($id)
    {
        $programKegiatan = ProgramKegiatan::findOrFail($id);
        return view('program_kegiatan.edit', compact('programKegiatan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_program' => 'required|string|max:50',
            'tahun_ajaran' => 'required|string|max:11',
            'deskripsi' => 'required|string|max:50',
        ]);

        $programKegiatan = ProgramKegiatan::findOrFail($id);
        $programKegiatan->update($request->all());

        return redirect()->route('program_kegiatan.index')->with('success', 'Program Kegiatan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $programKegiatan = ProgramKegiatan::findOrFail($id);
        $programKegiatan->delete();

        return redirect()->route('program_kegiatan.index')->with('success', 'Program Kegiatan berhasil dihapus.');
    }

    public function show($id)
    {
        $programKegiatan = ProgramKegiatan::with('ekstrakurikuler', 'ketua', 'pembina')->findOrFail($id);
        return response()->json($programKegiatan);
    }
}