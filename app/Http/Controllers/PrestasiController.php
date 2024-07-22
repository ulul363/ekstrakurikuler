<?php

namespace App\Http\Controllers;

use App\Models\Prestasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PrestasiController extends Controller
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
            $prestasi = Prestasi::with('ekstrakurikuler', 'ketua')
                ->whereHas('ekstrakurikuler', function ($query) use ($ekstrakurikulerId) {
                    $query->where('id_ekstrakurikuler', $ekstrakurikulerId);
                })
                ->get();
        } else {
            $ketuaId = $user->ketua->id_ketua;
            $prestasi = Prestasi::with('ekstrakurikuler', 'ketua')->where('ketua_id', $ketuaId)->get();
        }

        return view('prestasi.index', compact('prestasi'));
    }

    public function verifikasi(Request $request, $id)
    {
        $prestasi = Prestasi::findOrFail($id);

        $request->validate([
            'status' => 'required|in:disetujui,ditolak',
        ]);

        $prestasi->status = $request->input('status');
        $prestasi->verifikasi_id = auth()->user()->pembina->id_pembina;
        $prestasi->save();

        return redirect()->route('prestasi.index')->with('success', 'Kehadiran berhasil diverifikasi.');
    }

    public function create()
    {
        return view('prestasi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'prestasi' => 'required|string|max:50',
            'nama_siswa.*' => 'required|string|max:50',
            'tahun_ajaran' => 'required|integer',
            'berkas' => 'nullable|mimes:pdf,jpg,jpeg,png|max:2048', // max 2MB
        ]);

        // Pastikan pengguna yang login memiliki data ketua
        if (!Auth::user()->ketua) {
            return redirect()->route('prestasi.index')->withErrors('Pengguna yang login tidak memiliki data ketua yang valid.');
        }

        $ekstrakurikuler_id = Auth::user()->ketua->ekstrakurikuler_id;
        $ketua_id = Auth::user()->ketua->id_ketua;

        // Proses upload berkas jika ada
        $berkasPath = null;
        if ($request->hasFile('berkas')) {
            $berkas = $request->file('berkas');
            $fileName = time() . '_' . $berkas->getClientOriginalName();
            $berkasPath = $berkas->storeAs('uploads/prestasi', $fileName, 'public');
        }

        Prestasi::create([
            'prestasi' => $request->prestasi,
            'ekstrakurikuler_id' => $ekstrakurikuler_id,
            'ketua_id' => $ketua_id,
            'nama_siswa' => json_encode($request->nama_siswa), // Jika nama_siswa adalah array
            'tahun_ajaran' => $request->tahun_ajaran,
            'berkas' => $berkasPath,
            'status' => 'pending',
        ]);

        return redirect()->route('prestasi.index')->with('success', 'Prestasi berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $prestasi = Prestasi::findOrFail($id);
        return view('prestasi.edit', compact('prestasi'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'prestasi' => 'required|string|max:50',
            'nama_siswa.*' => 'required|string|max:50',
            'tahun_ajaran' => 'required|integer',
            'berkas' => 'nullable|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $prestasi = Prestasi::findOrFail($id);

        // Pastikan pengguna yang login memiliki data ketua
        if (!Auth::user()->ketua) {
            return redirect()->route('prestasi.index')->withErrors('Pengguna yang login tidak memiliki data ketua yang valid.');
        }

        $prestasi->prestasi = $request->prestasi;
        $prestasi->nama_siswa = json_encode($request->nama_siswa);
        $prestasi->tahun_ajaran = $request->tahun_ajaran;

        // Proses upload berkas jika ada
        if ($request->hasFile('berkas')) {
            // Hapus berkas lama jika ada
            if (Storage::disk('public')->exists($prestasi->berkas)) {
                Storage::disk('public')->delete($prestasi->berkas);
            }

            $fileName = time() . '_' . $request->file('berkas')->getClientOriginalName();
            $filePath = $request->file('berkas')->storeAs('uploads/prestasi', $fileName, 'public');
            $prestasi->berkas = $filePath;
        }

        $prestasi->save();

        return redirect()->route('prestasi.index')->with('success', 'Prestasi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $prestasi = Prestasi::findOrFail($id);
        if (Storage::disk('public')->exists($prestasi->berkas)) {
            Storage::disk('public')->delete($prestasi->berkas);
        }
        $prestasi->delete();

        return redirect()->route('prestasi.index')->with('success', 'Prestasi berhasil dihapus.');
    }

    public function show($id)
    {
        $prestasi = Prestasi::with('ekstrakurikuler', 'ketua', 'pembina')->findOrFail($id);
        return response()->json($prestasi);
    }
}
