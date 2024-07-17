<?php

namespace App\Http\Controllers;

use App\Models\Kehadiran;
use App\Models\Ekstrakurikuler;
use App\Models\Ketua;
use App\Models\Pembina;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class KehadiranController extends Controller
{
    public function index()
    {
        // Ambil kehadiran yang terhubung dengan ketua yang sedang login
        $ketuaId = Auth::user()->ketua->id_ketua;
        $kehadiran = Kehadiran::with('ekstrakurikuler', 'ketua', 'pembina')->where('ketua_id', $ketuaId)->get();

        return view('kehadiran.index', compact('kehadiran'));
    }

    public function create()
    {
        $ekstrakurikuler = Ekstrakurikuler::all();
        return view('kehadiran.create', compact('ekstrakurikuler'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'berkas' => 'nullable|mimes:pdf,jpg,jpeg,png|max:2048', // max 2MB
        ]);

        // Pastikan pengguna yang login memiliki data ketua
        if (!Auth::user()->ketua) {
            return redirect()->route('kehadiran.index')->withErrors('Pengguna yang login tidak memiliki data ketua yang valid.');
        }

        $ekstrakurikuler_id = Auth::user()->ketua->ekstrakurikuler_id;
        $ketua_id = Auth::user()->ketua->id_ketua;

        // Proses upload berkas jika ada
        $berkasPath = null;
        if ($request->hasFile('berkas')) {
            $berkas = $request->file('berkas');
            $fileName = time();
            $berkasPath = $request->file('berkas')->storeAs('uploads/kehadiran', $fileName, 'public');
        }

        Kehadiran::create([
            'ekstrakurikuler_id' => $ekstrakurikuler_id,
            'ketua_id' => $ketua_id,
            'tanggal' => $request->tanggal,
            'berkas' => $berkasPath,
            'status' => 'pending',
        ]);

        return redirect()->route('kehadiran.index')->with('success', 'Kehadiran berhasil diajukan.');
    }

    public function edit($id)
    {
        $kehadiran = Kehadiran::findOrFail($id);
        return view('kehadiran.edit', compact('kehadiran'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'berkas' => 'nullable|mimes:pdf,jpg,jpeg,png|max:2048', // max 2MB
        ]);

        $kehadiran = Kehadiran::findOrFail($id);

        // Pastikan pengguna yang login memiliki data ketua
        if (!Auth::user()->ketua) {
            return redirect()->route('kehadiran.index')->withErrors('Pengguna yang login tidak memiliki data ketua yang valid.');
        }

        $kehadiran->tanggal = $request->tanggal;

        // Proses update berkas jika ada
        if ($request->hasFile('berkas')) {
            // Hapus file lama jika ada
            if (Storage::disk('public')->exists($kehadiran->berkas)) {
                Storage::disk('public')->delete($kehadiran->berkas);
            }

            // Upload file baru
            $fileName = time();
            $filePath = $request->file('berkas')->storeAs('uploads/kehadiran', $fileName, 'public');
            $kehadiran->berkas = $filePath;
        }

        $kehadiran->save();

        return redirect()->route('kehadiran.index')->with('success', 'Kehadiran berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kehadiran = Kehadiran::findOrFail($id);

        // Hapus berkas terkait jika ada
        if (Storage::disk('public')->exists($kehadiran->berkas)) {
            Storage::disk('public')->delete($kehadiran->berkas);
        }

        $kehadiran->delete();

        return redirect()->route('kehadiran.index')->with('success', 'Kehadiran berhasil dihapus.');
    }

    public function show($id)
    {
        $kehadiran = Kehadiran::with('ekstrakurikuler', 'ketua', 'pembina')->findOrFail($id);
        return response()->json($kehadiran);
    }
}
