@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <div class="mb-6 flex items-center gap-4">
            <a href="{{ route('admin.patients.index') }}" class="text-gray-500 hover:text-gray-700">← Kembali</a>
            <h1 class="text-2xl font-bold text-gray-800">Detail Pasien: {{ $patient->name }}</h1>
        </div>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                {{ session('error') }}
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <!-- KOLOM KIRI: Profil & Form Catat Sesi -->
            <div class="lg:col-span-1 space-y-6">

                <!-- Card Profil Singkat -->
                <div class="bg-white shadow rounded-lg p-5 border-t-4 border-blue-600">
                    <h3 class="text-lg font-semibold text-gray-800 mb-3">Informasi Pasien</h3>
                    <div class="space-y-2 text-sm text-gray-600">
                        <p><strong>Usia:</strong> {{ $patient->age }} tahun</p>
                        <p><strong>Kontak:</strong> {{ $patient->phone }}</p>
                        <p><strong>Alamat:</strong> {{ $patient->address }}</p>
                        <hr class="my-2">
                        <p class="text-red-600"><strong>Penyakit Bawaan:</strong><br>
                            {{ $patient->underlying_conditions ?? 'Tidak ada catatan' }}</p>
                    </div>
                </div>

                <!-- Form Tambah Sesi (Sembunyikan jika sudah 10 sesi) -->
                @if ($patient->therapySessions->count() < 10)
                    <div class="bg-white shadow rounded-lg p-5">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Catat Sesi
                            {{ $patient->therapySessions->count() + 1 }}</h3>
                        <form action="{{ route('admin.sessions.store', $patient->id) }}" method="POST" class="space-y-4">
                            @csrf
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Tanggal Kunjungan</label>
                                <input type="date" name="session_date" value="{{ date('Y-m-d') }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                    required>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Level Alat (1-5)</label>
                                <select name="device_level"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                    required>
                                    @for ($i = 1; $i <= 5; $i++)
                                        <option value="{{ $i }}">Level {{ $i }}</option>
                                    @endfor
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Keluhan Hari Ini</label>
                                <input type="text" name="current_complaint"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm sm:text-sm"
                                    placeholder="Misal: Pundak kaku" required>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Nyeri Awal (1-10)</label>
                                    <input type="number" name="pain_scale_before" min="1" max="10"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm sm:text-sm" required>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Nyeri Akhir (1-10)</label>
                                    <input type="number" name="pain_scale_after" min="1" max="10"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm sm:text-sm" required>
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Respons Pasien</label>
                                <input type="text" name="patient_feedback"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm sm:text-sm"
                                    placeholder="Misal: Sedikit sakit">
                            </div>

                            <button type="submit"
                                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md shadow">
                                Simpan Sesi
                            </button>
                        </form>
                    </div>
                @else
                    <div class="bg-green-100 border border-green-400 text-green-700 p-4 rounded-lg text-center">
                        <span class="font-bold block text-lg">Paket Selesai</span>
                        Pasien telah menyelesaikan 10 sesi terapi.
                    </div>
                @endif
            </div>

            <!-- KOLOM KANAN: Timeline Sesi 1-10 -->
            <div class="lg:col-span-2">
                <div class="bg-white shadow rounded-lg p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-6">Progres Terapi
                        ({{ $patient->therapySessions->count() }}/10 Sesi)</h3>

                    @if ($patient->therapySessions->isEmpty())
                        <p class="text-gray-500 italic">Belum ada sesi terapi yang dicatat.</p>
                    @else
                        <!-- Container Timeline -->
                        <div class="relative border-l-2 border-blue-200 ml-3 space-y-8">
                            @foreach ($patient->therapySessions as $session)
                                <div class="relative pl-6">
                                    <!-- Titik Timeline -->
                                    <div
                                        class="absolute -left-[9px] top-1 h-4 w-4 rounded-full bg-blue-600 ring-4 ring-white">
                                    </div>

                                    <div class="bg-gray-50 rounded-lg p-4 border border-gray-100">
                                        <div class="flex justify-between items-start mb-2">
                                            <div>
                                                <span
                                                    class="bg-blue-100 text-blue-800 text-xs font-bold px-2 py-1 rounded">Sesi
                                                    {{ $session->session_sequence }}</span>
                                                <span
                                                    class="text-sm text-gray-500 ml-2">{{ \Carbon\Carbon::parse($session->session_date)->format('d M Y') }}</span>
                                            </div>
                                            <span
                                                class="text-sm font-semibold text-gray-700 bg-gray-200 px-2 py-1 rounded">Alat:
                                                Level {{ $session->device_level }}</span>
                                        </div>

                                        <p class="text-sm text-gray-800 mb-3"><strong>Keluhan:</strong>
                                            {{ $session->current_complaint }}</p>

                                        <div class="flex gap-4 mb-3">
                                            <div class="bg-red-50 px-3 py-2 rounded text-sm w-full">
                                                <span class="text-red-800 block text-xs">Nyeri Sebelum</span>
                                                <span
                                                    class="font-bold text-lg text-red-600">{{ $session->pain_scale_before }}</span>/10
                                            </div>
                                            <div class="bg-green-50 px-3 py-2 rounded text-sm w-full">
                                                <span class="text-green-800 block text-xs">Nyeri Sesudah</span>
                                                <span
                                                    class="font-bold text-lg text-green-600">{{ $session->pain_scale_after }}</span>/10
                                            </div>
                                        </div>

                                        <p class="text-sm text-gray-600"><strong>Respons:</strong>
                                            {{ $session->patient_feedback ?? '-' }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
@endsection
