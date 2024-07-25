<?php

namespace App\Http\Controllers;

use App\Models\JadwalPembina;
use App\Models\Ekstrakurikuler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JadwalPembinaController2 extends Controller
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
            $jadwalPembina = JadwalPembina::with('ekstrakurikuler')
                ->whereHas('ekstrakurikuler', function ($query) use ($ekstrakurikulerId) {
                    $query->where('id_ekstrakurikuler', $ekstrakurikulerId);
                })
                ->get();
        } else {
            $ketuaId = $user->ketua->id_ketua;
            $jadwalPembina = JadwalPembina::with('ekstrakurikuler')->where('ketua_id', $ketuaId)->get();
        }

        return view('jadwal_pembina.index2', compact('jadwalPembina'));
    }

    public function verifikasi(Request $request, $id)
    {
        $jadwalPembina = JadwalPembina::findOrFail($id);

        $request->validate([
            'status' => 'required|in:disetujui,ditolak',
        ]);

        $jadwalPembina->status = $request->input('status');
        $jadwalPembina->verifikasi_id = auth()->user()->pembina->id_pembina;
        $jadwalPembina->save();

        return redirect()->route('jadwal_pembina.index2')->with('success', 'Jadwal pembina berhasil diverifikasi.');
    }

    public function create()
    {
        $ekstrakurikuler = Ekstrakurikuler::all();
        return view('jadwal_pembina.create2', compact('ekstrakurikuler'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pembina_id' => 'required|exists:pembina,id_pembina',
            'hari' => 'required|string',
            'waktu_mulai' => 'required|date_format:H:i',
            'waktu_selesai' => 'required|date_format:H:i|after:waktu_mulai',
            'status' => 'required|string',
        ]);

        if (!Auth::user()->ketua) {
            return redirect()->route('jadwal_pembina.index2')->withErrors('Pengguna yang login tidak memiliki data ketua yang valid.');
        }

        $ekstrakurikuler_id = Auth::user()->ketua->ekstrakurikuler_id;
        $ketua_id = Auth::user()->ketua->id_ketua;

        JadwalPembina::create([
            'ekstrakurikuler_id' => $ekstrakurikuler_id,
            'pembina_id' => $request->pembina_id,
            'hari' => $request->hari,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai,
            'status' => $request->status,
        ]);

        return redirect()->route('jadwal_pembina.index2')->with('success', 'Jadwal pembina berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $jadwalPembina = JadwalPembina::findOrFail($id);
        $ekstrakurikuler = Ekstrakurikuler::all();
        return view('jadwal_pembina.edit2', compact('jadwalPembina', 'ekstrakurikuler'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'pembina_id' => 'required|exists:pembina,id_pembina',
            'hari' => 'required|string',
            'waktu_mulai' => 'required|date_format:H:i',
            'waktu_selesai' => 'required|date_format:H:i|after:waktu_mulai',
            'status' => 'required|string',
        ]);

        $jadwalPembina = JadwalPembina::findOrFail($id);

        if (!Auth::user()->ketua) {
            return redirect()->route('jadwal_pembina.index2')->withErrors('Pengguna yang login tidak memiliki data ketua yang valid.');
        }

        $jadwalPembina->pembina_id = $request->pembina_id;
        $jadwalPembina->hari = $request->hari;
        $jadwalPembina->waktu_mulai = $request->waktu_mulai;
        $jadwalPembina->waktu_selesai = $request->waktu_selesai;
        $jadwalPembina->status = $request->status;
        $jadwalPembina->save();

        return redirect()->route('jadwal_pembina.index2')->with('success', 'Jadwal pembina berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $jadwalPembina = JadwalPembina::findOrFail($id);
        $jadwalPembina->delete();

        return redirect()->route('jadwal_pembina.index2')->with('success', 'Jadwal pembina berhasil dihapus.');
    }

    public function show($id)
    {
        $jadwalPembina = JadwalPembina::with('ekstrakurikuler', 'pembina')->findOrFail($id);
        return response()->json($jadwalPembina);
    }
}
