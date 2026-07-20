<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class DeveloperController extends Controller
{
    /**
     * Membersihkan cache Laravel
     */
    public function clearCache()
    {
        // Hanya developer yang bisa akses via middleware, tapi kita pastikan lagi jika perlu.
        if (Auth::user()->role !== 'developer') {
            abort(403);
        }

        Artisan::call('optimize:clear');
        
        return back()->with('success', 'Semua Cache berhasil dibersihkan!');
    }

    /**
     * Generate data pengguna secara acak (Dummy Data)
     */
    public function generateDummyData()
    {
        if (Auth::user()->role !== 'developer') {
            abort(403);
        }

        // Generate 5 user dummy
        User::factory()->count(5)->create([
            'role' => 'user' // pastikan rolenya user biasa
        ]);

        return back()->with('success', '5 Pengguna Dummy berhasil ditambahkan!');
    }

    /**
     * Fitur Impersonate: Masuk sebagai pengguna lain
     */
    public function impersonate($id)
    {
        if (Auth::user()->role !== 'developer') {
            abort(403);
        }

        $userToImpersonate = User::findOrFail($id);
        
        // Login sebagai pengguna tersebut
        Auth::login($userToImpersonate);

        return redirect()->route('dashboard')->with('success', 'Anda sekarang masuk sebagai ' . $userToImpersonate->name);
    }
}
