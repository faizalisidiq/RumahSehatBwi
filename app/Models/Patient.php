<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patient extends Model
{
    use HasFactory, SoftDeletes;

    // Mengizinkan penyimpanan data massal
    protected $fillable = [
        'name',
        'phone',
        'address',
        'age',
        'underlying_condition'
    ];

    // Relasi: 1 pasien punya banyak sesi terapi
    public function therapySessions() {
        return $this->hasMany(TherapySession::class);
    }
}
