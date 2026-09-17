@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Data Pasien Homecare</h1>
            <!-- Tombol ini bisa dihubungkan ke modal atau halaman create -->
            <a href="{{ route('admin.patients.create') }}"
                class="bg-teal-600 hover:bg-teal-700 text-white px-4 py-2 rounded-lg text-sm font-medium">
                Tambah Pasien
            </a>
        </div>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                {{ session('success') }}
            </div>
        @endif

        <!-- Tabel Pasien -->
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama
                            Pasien</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kontak
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Alamat
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($patients as $patient)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $patient->name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $patient->phone ?? '-' }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500 truncate max-w-xs">{{ $patient->address }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex gap-2">
                                <!-- Tombol Detail -->
                                <a href="{{ route('admin.patients.show', $patient->id) }}"
                                    class="text-blue-600 hover:text-blue-900 bg-blue-50 px-3 py-1 rounded-md">Detail</a>

                                <!-- Tombol Edit -->
                                <a href="{{ route('admin.patients.edit', $patient->id) }}"
                                    class="text-yellow-600 hover:text-yellow-900 bg-yellow-50 px-3 py-1 rounded-md">Edit</a>

                                <!-- Tombol Hapus (Menggunakan Form karena butuh method DELETE) -->
                                <form action="{{ route('admin.patients.destroy', $patient->id) }}" method="POST"
                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus data pasien ini?');"
                                    class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="text-red-600 hover:text-red-900 bg-red-50 px-3 py-1 rounded-md border border-red-100">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="px-6 py-3 border-t border-gray-200">
                {{ $patients->links() }}
            </div>
        </div>
    </div>
@endsection
