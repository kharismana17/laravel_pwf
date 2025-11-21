<?php

namespace App\Http\Controllers;

use App\Models\Aktivitas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class AktivitasController extends Controller
{
    public function index()
    {
        $data = Aktivitas::latest()->get();
        return view('aktivitas.index', compact('data'));
    }

    public function create()
    {
        return view('aktivitas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_aktivitas' => 'required|string|max:255',
            'deskripsi' => 'required|string',
        ]);

       Aktivitas::create([
        'nama_aktivitas' => $request->nama_aktivitas,
        'deskripsi' => $request->deskripsi,
        'tanggal' => now(), 
]);
        return redirect()->route('aktivitas.index')
                         ->with('success', 'Aktivitas berhasil ditambahkan.');
    }

    public function edit(Aktivitas $aktivitas)
    {
        return view('aktivitas.edit', compact('aktivitas'));
    }

    public function update(Request $request, Aktivitas $aktivitas)
    {
        $request->validate([
            'nama_aktivitas' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal' => 'nullable|date',
            'status' => 'nullable|boolean',
        ]);

        $aktivitas->update([
            'nama_aktivitas' => $request->nama_aktivitas,
            'deskripsi' => $request->deskripsi,
            'tanggal' => $request->tanggal ?? $aktivitas->tanggal,
            'status' => $request->has('status') ? $request->status : $aktivitas->status,    
        ]);

        return redirect()->route('aktivitas.index')
                         ->with('success', 'Aktivitas berhasil diperbarui.');
    }

    public function destroy(Aktivitas $aktivitas)
    {
        $aktivitas->delete();

        return redirect()->route('aktivitas.index')
                         ->with('success', 'Aktivitas berhasil dihapus.');
    }
    public function show($id)
    {
    $aktivitas = \App\Models\Aktivitas::findOrFail($id);
    return view('aktivitas.show', compact('aktivitas'));
    }

}
