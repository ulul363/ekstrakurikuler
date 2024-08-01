<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengajuanPertemuan;
use App\Models\Ketua;
use App\Models\Pembina;
use Illuminate\Support\Facades\Auth;

class PengajuanPertemuanController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->hasRole('Pembina')) {
            $pembina = $user->pembina;

            if (!$pembina) {
                abort(403, 'Pembina data not found.');
            }

            $pertemuan = PengajuanPertemuan::with('ketua') // Changed from 'pembina' to 'ketua'
                ->where('pembina_id', $pembina->id_pembina)
                ->get();
        } else {
            $ketuaId = $user->ketua->id_ketua;
            $pertemuan = PengajuanPertemuan::with('ketua')
                ->where('ketua_id', $ketuaId)
                ->get();
        }
        // dd($pertemuan);

        return view('pertemuan.index', compact('pertemuan'));
    }

    public function verifikasi(Request $request, $id)
    {
        $pertemuan = PengajuanPertemuan::findOrFail($id);
        // dd($pertemuan);

        $request->validate([
            'status' => 'required|in:disetujui,ditolak',
        ]);

        $pertemuan->status = $request->input('status');
        $pertemuan->verifikasi_id = auth()->user()->pembina->id_pembina ?? null;
        $pertemuan->waktu_verifikasi = now();
        $pertemuan->save();

        // if ($pertemuan->status == 'ditolak') {
        //     return redirect()->route('chatroom.show', $pertemuan->id_pengajuan_pertemuan)->with('success', 'Pertemuan ditolak dan Anda diarahkan ke chatroom.');
        // }

        return redirect()->route('pertemuan.index')->with('success', 'Pertemuan berhasil diverifikasi.');
    }

    public function create()
    {
        if (!Auth::user()->ketua) {
            return redirect()->route('pertemuan.index')->withErrors('Pengguna yang login tidak memiliki data ketua yang valid.');
        }

        $ekstrakurikuler_id = Auth::user()->ketua->ekstrakurikuler_id;
        $pembina = Pembina::where('ekstrakurikuler_id', $ekstrakurikuler_id)->get(); // Changed to get() to allow multiple Pembina

        if ($pembina->isEmpty()) {
            return redirect()->route('pertemuan.index')->withErrors('Tidak ada pembina yang ditemukan untuk ekstrakurikuler ini.');
        }

        return view('pertemuan.create', compact('pembina'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'pembina_id' => 'required|exists:pembina,id_pembina',
            // 'rencana_pertemuan' => 'required|date_format:Y-m-d\TH:i',
            'hari' => 'required|string',
            'tanggal' => 'required|date',
            'waktu' => 'required|date_format:H:i',
        ]);

        if (!Auth::user()->ketua) {
            return redirect()->route('pertemuan.index')->withErrors('Pengguna yang login tidak memiliki data ketua yang valid.');
        }

        $ketua_id = Auth::user()->ketua->id_ketua;

        PengajuanPertemuan::create([
            'ketua_id' => $ketua_id,
            'pembina_id' => $request->pembina_id,
            // 'rencana_pertemuan' => $request->rencana_pertemuan,
            'hari' => $request->hari,
            'tanggal' => $request->tanggal,
            'waktu' => $request->waktu,
            'status' => 'pending',
        ]);

        return redirect()->route('pertemuan.index')->with('success', 'Pertemuan berhasil diajukan.');
    }


    public function edit($id)
    {
        $pertemuan = PengajuanPertemuan::findOrFail($id);
        return view('pertemuan.edit', compact('pertemuan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            // 'rencana_pertemuan' => 'required|string', 
            'waktu_verifikasi' => 'nullable|date_format:Y-m-d\TH:i',
        ]);

        $pertemuan = PengajuanPertemuan::findOrFail($id);

        if (!Auth::user()->ketua) {
            return redirect()->route('pertemuan.index')->withErrors('Pengguna yang login tidak memiliki data ketua yang valid.');
        }

        // $pertemuan->rencana_pertemuan = $request->rencana_pertemuan;
        $pertemuan->waktu_verifikasi = $request->waktu_verifikasi;
        $pertemuan->save();

        return redirect()->route('pertemuan.index')->with('success', 'Pertemuan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pertemuan = PengajuanPertemuan::findOrFail($id);
        $pertemuan->delete();
        return redirect()->route('pertemuan.index')->with('success', 'Pertemuan berhasil dihapus.');
    }

    public function show($id)
    {
        $pertemuan = PengajuanPertemuan::with('ketua', 'pembina')->findOrFail($id);
        return response()->json($pertemuan);
    }
}
