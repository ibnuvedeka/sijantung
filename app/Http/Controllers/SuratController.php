<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use Illuminate\Http\Request;

class SuratController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // 1. Siapkan mesin pencari
        $query = Surat::query();

        // 2. Jika ada ketikan di kotak pencarian, saring datanya
        if ($request->has('search')) {
            $katakunci = $request->search;
            $query->where('nomor_surat', 'LIKE', "%{$katakunci}%")
                  ->orWhere('perihal', 'LIKE', "%{$katakunci}%")
                  ->orWhere('pengirim', 'LIKE', "%{$katakunci}%");
        }

        // 3. Ambil datanya (latest() agar data terbaru selalu muncul paling atas)
        $surats = $query->latest()->get(); 
        
        return view('surat.index', compact('surats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    // Membuka halaman form tambah data
    return view('surat.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    // 1. Validasi data (memastikan form tidak ada yang kosong)
    $request->validate([
        'nomor_surat' => 'required|string|max:255',
        'perihal' => 'required|string|max:255',
        'tanggal_surat' => 'required|date',
        'pengirim' => 'required|string|max:255',
        'status' => 'required|in:Masuk,Keluar',
        'file_pdf' => 'nullable|mimes:pdf|max:10240', // max 10MB
    ]);

    $data = $request->all();

    if ($request->hasFile('file_pdf')) {
        $file = $request->file('file_pdf');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('uploads/surat'), $filename);
        $data['file_pdf'] = 'uploads/surat/' . $filename;
    }

    // 2. Simpan data ke dalam tabel surats
    Surat::create($data);

    // 3. Kembalikan user ke halaman tabel dengan pesan sukses
    return redirect()->route('surat.index')->with('success', 'Data surat berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    // 1. Fungsi Show (Detail)
    public function show(string $id)
    {
        // Sementara kita arahkan kembali ke tabel saja, 
        // kecuali nanti Anda butuh halaman khusus untuk print/cetak detail surat.
        return redirect()->route('surat.index');
    }

    // 2. Fungsi Edit (Membuka Form Edit)
    public function edit(string $id)
    {
        $surat = Surat::findOrFail($id);
        return view('surat.edit', compact('surat'));
    }

    // 3. Fungsi Update (Menyimpan Perubahan)
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nomor_surat' => 'required|string|max:255',
            'perihal' => 'required|string|max:255',
            'tanggal_surat' => 'required|date',
            'pengirim' => 'required|string|max:255',
            'status' => 'required|in:Masuk,Keluar',
            'file_pdf' => 'nullable|mimes:pdf|max:10240',
        ]);

        $surat = Surat::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('file_pdf')) {
            // Hapus file lama jika ada
            if ($surat->file_pdf && file_exists(public_path($surat->file_pdf))) {
                unlink(public_path($surat->file_pdf));
            }
            $file = $request->file('file_pdf');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/surat'), $filename);
            $data['file_pdf'] = 'uploads/surat/' . $filename;
        }

        $surat->update($data);

        return redirect()->route('surat.index')->with('success', 'Data surat berhasil diperbarui!');
    }

    // 4. Fungsi Destroy (Menghapus Data)
    public function destroy(string $id)
    {
        $surat = Surat::findOrFail($id);
        
        // Hapus file PDF jika ada
        if ($surat->file_pdf && file_exists(public_path($surat->file_pdf))) {
            unlink(public_path($surat->file_pdf));
        }

        $surat->delete();

        return redirect()->route('surat.index')->with('success', 'Data surat berhasil dihapus!');
    }
}
