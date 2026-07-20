<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rka;
use App\Models\TransaksiKartuKendali;

class KartuKendaliController extends Controller
{
    public function index()
    {
        // Mengambil semua data RKA dan Transaksi dari tabel MySQL
        $rkas = \App\Models\Rka::all();
        $transaksis = \App\Models\TransaksiKartuKendali::all();

        // Mengirim data tersebut ke file tampilan index.blade.php
        return view('kartu_kendali.index', compact('rkas', 'transaksis')); 
        // Catatan: sesuaikan 'kartu_kendali.index' dengan nama folder dan file blade Anda
    }

    public function store(Request $request)
    {
        // Validasi inputan demi keamanan
        $validated = $request->validate([
            'kode' => 'required|string',
            'tanggal' => 'required|date',
            'uraian' => 'required|string',
            'jumlah' => 'required|numeric',
        ]);

        // Cari data RKA berdasarkan kode rekening
        $rka = Rka::findOrFail($request->id);

        // Cek pakah saldo mencukupi
        if ($validated['jumlah'] > $rka->sisa) {
            return response()->json(['message' => 'Saldo tidak mencukupi!'], 422);
        }

        // Potong sisa anggaran RKA saat ini
        $rka->sisa -= $validated['jumlah'];
        $rka->save();

        // Simpan catatan transaksi ke database MySQL
        $transaksi = TransaksiKartuKendali::create([
            'rka_id' => $rka->id,
            'tanggal' => $validated['tanggal'],
            'kode' => $validated['kode'],
            'uraian' => $validated['uraian'],
            'jumlah' => $validated['jumlah'],
            'sisa_akhir' => $rka->sisa, // Hitung otomatis sisa sesudahnya
        ]);

        return response()->json(['success' => true, 'data' => $transaksi]);
    }

    public function destroy($id)
    {
        $transaksi = TransaksiKartuKendali::findOrFail($id);
        $rka = Rka::findOrFail($transaksi->rka_id);

        // Kembalikan sisa anggaran
        $rka->sisa += $transaksi->jumlah;
        $rka->save();

        // Hapus transaksi
        $transaksi->delete();

        return response()->json(['success' => true, 'message' => 'Transaksi berhasil dihapus.']);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'uraian' => 'required|string',
            'jumlah' => 'required|numeric',
        ]);

        $transaksi = TransaksiKartuKendali::findOrFail($id);
        $rka = Rka::findOrFail($transaksi->rka_id);

        // Cek selisih jumlah untuk memastikan saldo cukup
        $selisih = $validated['jumlah'] - $transaksi->jumlah;
        if ($selisih > $rka->sisa) {
            return response()->json(['message' => 'Saldo tidak mencukupi untuk penambahan ini!'], 422);
        }

        // Sesuaikan sisa anggaran
        $rka->sisa -= $selisih;
        $rka->save();

        // Update transaksi
        $transaksi->update([
            'tanggal' => $validated['tanggal'],
            'uraian' => $validated['uraian'],
            'jumlah' => $validated['jumlah'],
            'sisa_akhir' => $rka->sisa, // asumsikan urutan terakhir
        ]);

        return response()->json(['success' => true, 'data' => $transaksi]);
    }
}