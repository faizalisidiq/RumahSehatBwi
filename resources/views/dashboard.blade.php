@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

        <!-- Hero Section -->
        <div class="bg-teal-600 rounded-2xl shadow-xl overflow-hidden mb-8">
            <div class="px-8 py-12 md:p-16 text-center">
                <h1 class="text-3xl md:text-4xl font-extrabold text-white mb-4">
                    Rumah Sehat Banyuwangi <br> <span class="text-[#0D9488]">Sahabat Sehat Keluarga Banyuwangi</span>
                </h1>
            </div>
        </div>

        <!-- Statistik Singkat (Placeholder / Statik sementara) -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                <div class="text-gray-500 text-sm font-bold mb-1">Total Pasien Aktif</div>
                <div class="text-3xl font-bold text-teal-600">{{ $totalPatients }} orang</div>
            </div>
            <div>

            </div>
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                <div class="text-gray-500 text-sm font-bold mb-1">Total Pasien Hari Ini</div>
                <div class="text-3xl font-bold text-teal-600">{{ $totalPatientsToday }} orang</div>
            </div>
        </div>

    </div>
@endsection
