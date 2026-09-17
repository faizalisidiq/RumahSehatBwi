<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TherapySession extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'user_id',
        'session_date',
        'session_sequence',
        'device_level',
        'current_complaint',
        'pain_scale_before',
        'pain_scale_after',
        'patient_feedback',
        'evaluation_notes'
    ];

    // Relasi: Sesi ini milik siapa?
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    // Relasi: Siapa terapis yang menangani? (Ke tabel users bawaan Laravel)
    public function therapist()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
