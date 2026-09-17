<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    // Tampilkan daftar semua pasien
    public function index()
    {
        $patients = Patient::latest()->paginate(10);
        return view('admin.patients.index', compact('patients'));
    }

    // Tampilkan form untuk menambahkan pasien
    public function create()
    {
        return view('admin.patients.create');
    }

    // Simpan data pasien baru ke database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'required|string',
            'age' => 'nullable|integer',
            'underlying_conditions' => 'nullable|string',
        ]);

        Patient::create($validated);

        return redirect()->route('admin.patients.index')
            ->with('success', 'Pasien berhasil didaftarkan.');
    }

    // Tampilkan profil spesifik pasien beserta histori terapinya
    public function show($id)
    {
        // Memuat pasien sekaligus memuat relasi sesi terapinya (diurutkan dari sesi awal)
        $patient = Patient::with(['therapySessions' => function ($query) {
            $query->orderBy('session_sequence', 'asc');
        }])->findOrFail($id);

        return view('admin.patients.show', compact('patient'));
    }

    // Menampilkan form edit data pasien
    public function edit($id)
    {
        $patient = Patient::findOrFail($id);
        return view('admin.patients.edit', compact('patient'));
    }

    // Memproses perubahan data pasien
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'required|string',
            'age' => 'nullable|integer',
            'underlying_conditions' => 'nullable|string',
        ]);

        $patient = Patient::findOrFail($id);
        $patient->update($validated);

        return redirect()->route('admin.patients.index')
            ->with('success', 'Data pasien berhasil diperbarui.');
    }

    // Menghapus data pasien
    public function destroy($id)
    {
        $patient = Patient::findOrFail($id);

        // Karena di awal kita pasang SoftDeletes, data ini tidak benar-benar hilang dari database,
        // hanya ditandai "deleted_at" agar riwayat terapinya tetap aman untuk arsip.
        $patient->delete();

        return redirect()->route('admin.patients.index')
            ->with('success', 'Data pasien berhasil dihapus.');
    }
}
