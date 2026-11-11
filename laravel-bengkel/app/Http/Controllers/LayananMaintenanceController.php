<?php

namespace App\Http\Controllers;

use App\Models\LayananMaintenance;
use Illuminate\Http\Request;

class LayananMaintenanceController extends Controller
{
    // Menampilkan halaman utama (Read)
    public function index()
    {
        $layanan = LayananMaintenance::orderBy('created_at', 'DESC')->get();
        return view('bengkel.index', compact('layanan'));
    }

    // Menyimpan data baru (Create)
    public function store(Request $request)
    {
        $request->validate([
            'nama_bengkel' => 'required|string|max:255',
            'jenis_layanan' => 'required|string',
            'catatan' => 'nullable|string',
        ]);

        LayananMaintenance::create($request->all());

        return redirect()->route('bengkel.index')->with('success', 'Data layanan maintenance berhasil disimpan!');
    }

    // Menampilkan form edit (Update)
    public function edit($id)
    {
        $item = LayananMaintenance::findOrFail($id);
        $layanan = LayananMaintenance::orderBy('created_at', 'DESC')->get();
        return view('bengkel.index', compact('item', 'layanan'));
    }

    // Memperbarui data (Update)
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_bengkel' => 'required|string|max:255',
            'jenis_layanan' => 'required|string',
            'catatan' => 'nullable|string',
        ]);

        $item = LayananMaintenance::findOrFail($id);
        $item->update($request->all());

        return redirect()->route('bengkel.index')->with('success', 'Data layanan maintenance berhasil diperbarui!');
    }

    // Menghapus data (Delete)
    public function destroy($id)
    {
        $item = LayananMaintenance::findOrFail($id);
        $item->delete();

        return redirect()->route('bengkel.index')->with('success', 'Data layanan maintenance berhasil dihapus!');
    }
}
