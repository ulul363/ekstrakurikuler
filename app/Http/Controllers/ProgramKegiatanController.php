<?php

namespace App\Http\Controllers;

use App\Models\ProgramKegiatan;
use App\Models\Ekstrakurikuler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProgramKegiatanController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->hasRole('Pembina')) {
            $pembina = $user->pembina;

            if (!$pembina) {
                abort(403, 'Pembina data not found.');
            }

            $ekstrakurikulerId = $pembina->ekstrakurikuler_id;
            $programKegiatan = ProgramKegiatan::with('ekstrakurikuler', 'ketua')
                ->whereHas('ekstrakurikuler', function ($query) use ($ekstrakurikulerId) {
                    $query->where('id_ekstrakurikuler', $ekstrakurikulerId);
                })
                ->get();
        } else {
            $ketuaId = $user->ketua->id_ketua;
            $programKegiatan = ProgramKegiatan::with('ekstrakurikuler', 'ketua', 'pembina')->where('ketua_id', $ketuaId)->get();
        }

        return view('program_kegiatan.index', compact('programKegiatan'));
    }

    public function verifikasi(Request $request, $id)
    {
        $programKegiatan = ProgramKegiatan::findOrFail($id);

        $request->validate([
            'status' => 'required|in:disetujui,ditolak',
            'keterangan' => 'nullable|string',
        ]);

        $programKegiatan->status = $request->input('status');
        $programKegiatan->keterangan = $request->keterangan;
        $programKegiatan->pembina_id = auth()->user()->pembina->id_pembina;
        $programKegiatan->save();

        return redirect()->route('program_kegiatan.index')->with('success', 'Program kegiatan berhasil diverifikasi.');
    }

    public function create()
    {
        return view('program_kegiatan.create');
    }

    public function store(Request $request)
    {
        $currentYear = date('Y');

        $request->validate([
            'nama_program' => 'required|string|max:50',
            'tahun_ajaran' => 'required|integer|in:' . $currentYear,
            'deskripsi' => 'required|string|max:200',
        ]);

        if (Auth::user()->ketua) {
            $ekstrakurikuler_id = Auth::user()->ketua->ekstrakurikuler_id;
            $ketua_id = Auth::user()->ketua->id_ketua;

            ProgramKegiatan::create([
                'ekstrakurikuler_id' => $ekstrakurikuler_id,
                'ketua_id' => $ketua_id,
                'nama_program' => $request->nama_program,
                'tahun_ajaran' => $request->tahun_ajaran,
                'deskripsi' => $request->deskripsi,
                'status' => 'pending',
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
        $currentYear = date('Y');

        $request->validate([
            'nama_program' => 'required|string|max:50',
            'tahun_ajaran' => 'required|integer|in:' . $currentYear,
            'deskripsi' => 'required|string|max:200',
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
