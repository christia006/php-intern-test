<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Karyawan</title>
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
    <div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow-md">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">Detail Karyawan</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <p class="text-gray-600 text-sm">Nomor:</p>
                <p class="text-gray-800 text-lg font-semibold">{{ $employee->nomor }}</p>
            </div>
            <div>
                <p class="text-gray-600 text-sm">Nama:</p>
                <p class="text-gray-800 text-lg font-semibold">{{ $employee->nama }}</p>
            </div>
            <div>
                <p class="text-gray-600 text-sm">Jabatan:</p>
                <p class="text-gray-800 text-lg font-semibold">{{ $employee->jabatan ?? '-' }}</p>
            </div>
            <div>
                <p class="text-gray-600 text-sm">Tanggal Lahir:</p>
                <p class="text-gray-800 text-lg font-semibold">{{ $employee->talahir ? $employee->talahir->format('d M Y') : '-' }}</p>
            </div>
            <div>
                <p class="text-gray-600 text-sm">Dibuat Pada:</p>
                <p class="text-gray-800 text-lg font-semibold">{{ $employee->created_on ? $employee->created_on->format('d M Y H:i:s') : '-' }}</p>
            </div>
            <div>
                <p class="text-gray-600 text-sm">Dibuat Oleh:</p>
                <p class="text-gray-800 text-lg font-semibold">{{ $employee->created_by ?? '-' }}</p>
            </div>
            <div>
                <p class="text-gray-600 text-sm">Diperbarui Pada:</p>
                <p class="text-gray-800 text-lg font-semibold">{{ $employee->updated_on ? $employee->updated_on->format('d M Y H:i:s') : '-' }}</p>
            </div>
            <div>
                <p class="text-gray-600 text-sm">Diperbarui Oleh:</p>
                <p class="text-gray-800 text-lg font-semibold">{{ $employee->updated_by ?? '-' }}</p>
            </div>
            <div>
                <p class="text-gray-600 text-sm">Dihapus Pada:</p>
                <p class="text-gray-800 text-lg font-semibold">{{ $employee->deleted_on ?? '-' }}</p>
            </div>
        </div>

        <div class="mb-6">
            <p class="text-gray-600 text-sm">Foto:</p>
            @if ($employee->photo_upload_path)
                <img src="{{ Storage::url($employee->photo_upload_path) }}" alt="Foto {{ $employee->nama }}" class="w-48 h-48 object-cover rounded-lg shadow-md mt-2">
            @else
                <p class="text-gray-600">Tidak ada foto.</p>
            @endif
        </div>

        <div class="flex justify-start">
            <a href="{{ route('employees.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition duration-300 ease-in-out">
                Kembali ke Daftar Karyawan
            </a>
        </div>
    </div>
</body>
</html>
