<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Karyawan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
        }
    </style>
</head>
<body class="p-6">
    <div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-md">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">Daftar Karyawan</h1>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Berhasil!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <div class="flex justify-end mb-4">
            <a href="{{ route('employees.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition duration-300 ease-in-out">
                Tambah Karyawan Baru
            </a>
        </div>

        @if ($employees->isEmpty())
            <p class="text-gray-600 text-center">Belum ada data karyawan.</p>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider rounded-tl-lg">Nomor</th>
                            <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Nama</th>
                            <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Jabatan</th>
                            <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Tanggal Lahir</th>
                            <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Foto</th>
                            <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider rounded-tr-lg">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employees as $employee)
                            <tr class="border-b border-gray-200 hover:bg-gray-50">
                                <td class="py-3 px-4 text-sm text-gray-800">{{ $employee->nomor }}</td>
                                <td class="py-3 px-4 text-sm text-gray-800">{{ $employee->nama }}</td>
                                <td class="py-3 px-4 text-sm text-gray-800">{{ $employee->jabatan ?? '-' }}</td>
                                <td class="py-3 px-4 text-sm text-gray-800">{{ $employee->talahir ? $employee->talahir->format('d M Y') : '-' }}</td>
                                <td class="py-3 px-4 text-sm text-gray-800">
                                    @if ($employee->photo_upload_path)
                                        <img src="{{ Storage::url($employee->photo_upload_path) }}" alt="Foto {{ $employee->nama }}" class="w-12 h-12 object-cover rounded-full shadow-sm">
                                    @else
                                        <span class="text-gray-500">Tidak ada foto</span>
                                    @endif
                                </td>
                                <td class="py-3 px-4 text-sm text-gray-800">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('employees.show', $employee->id) }}" class="bg-indigo-500 hover:bg-indigo-600 text-white py-1 px-3 rounded-lg text-xs font-semibold transition duration-300 ease-in-out">Lihat</a>
                                        <a href="{{ route('employees.edit', $employee->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white py-1 px-3 rounded-lg text-xs font-semibold transition duration-300 ease-in-out">Edit</a>
                                        <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus karyawan ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white py-1 px-3 rounded-lg text-xs font-semibold transition duration-300 ease-in-out">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</body>
</html>
