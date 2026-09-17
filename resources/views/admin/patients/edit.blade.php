@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <div class="mb-6 flex items-center gap-4">
            <a href="{{ route('admin.patients.index') }}" class="text-gray-500 hover:text-gray-700">← Kembali</a>
            <h1 class="text-2xl font-bold text-gray-800">Edit Data Pasien: {{ $patient->name }}</h1>
        </div>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                <strong class="font-bold">Oops! Ada kesalahan:</strong>
                <ul class="list-disc pl-5 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white shadow-md rounded-lg overflow-hidden p-6 border-t-4 border-yellow-500">
            <!-- Perhatikan action mengarah ke update dan ada @method('PUT') -->
            <form action="{{ route('admin.patients.update', $patient->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700">Nama Lengkap *</label>
                        <input type="text" name="name" value="{{ old('name', $patient->name) }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm border p-2" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nomor Telepon/WA</label>
                        <input type="text" name="phone" value="{{ old('phone', $patient->phone) }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm border p-2">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Usia (Tahun)</label>
                        <input type="number" name="age" value="{{ old('age', $patient->age) }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm border p-2">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Alamat Lengkap *</label>
                    <textarea name="address" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm border p-2"
                        required>{{ old('address', $patient->address) }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Riwayat Penyakit Bawaan</label>
                    <textarea name="underlying_conditions" rows="2"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm border p-2">{{ old('underlying_conditions', $patient->underlying_conditions) }}</textarea>
                </div>

                <div class="pt-4 border-t border-gray-200">
                    <button type="submit"
                        class="w-full bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-3 px-4 rounded-md shadow transition-colors">
                        Update Data Pasien
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
