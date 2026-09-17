<?php

namespace App\Http\Controllers;

use App\Models\TherapySession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TherapySessionController extends Controller
{
    public function store(Request $request, $patient_id)
    {
        // 1. Validasi input dari form terapis
        $validated = $request->validate([
            'session_date' => 'required|date',
            'device_level' => 'required|integer|min:1|max:5',
            'current_complaint' => 'required|string',
            'pain_scale_before' => 'required|integer|min:1|max:10',
            'pain_scale_after' => 'required|integer|min:1|max:10',
            'patient_feedback' => 'nullable|string',
            'evaluation_notes' => 'nullable|string',
        ]);

        // 2. Hitung jumlah sesi yang sudah dilakukan pasien ini
        $previousSessionsCount = TherapySession::where('patient_id', $patient_id)->count();
        $currentSequence = $previousSessionsCount + 1;

        // 3. Validasi maksimal 10 sesi (Paket Terapi)
        if ($currentSequence > 10) {
            return redirect()->back()
                ->with('error', 'Pasien ini sudah menyelesaikan paket maksimal 10 sesi terapi.');
        }

        // 4. Gabungkan data dengan informasi terapis & urutan sesi
        $validated['patient_id'] = $patient_id;
        $validated['user_id'] = null; // Ambil ID terapis yang sedang login
        $validated['session_sequence'] = $currentSequence;

        // 5. Simpan ke database
        TherapySession::create($validated);

        // 6. Kembali ke halaman detail pasien dengan pesan sukses
        return redirect()->route('admin.patients.show', $patient_id)
            ->with('success', "Data terapi sesi ke-{$currentSequence} berhasil dicatat.");
    }
}
