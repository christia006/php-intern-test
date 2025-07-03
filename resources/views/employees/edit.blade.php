<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Karyawan</title>
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
        <h1 class="text-3xl font-bold mb-6 text-gray-800">Edit Karyawan: {{ $employee->nama }}</h1>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Ada kesalahan!</strong>
                <ul class="mt-2 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('employees.update', $employee->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="nomor" class="block text-gray-700 text-sm font-bold mb-2">Nomor:</label>
                <input type="text" name="nomor" id="nomor" value="{{ old('nomor', $employee->nomor) }}" class="shadow appearance-none border rounded-lg w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('nomor') border-red-500 @enderror" required>
                @error('nomor')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="nama" class="block text-gray-700 text-sm font-bold mb-2">Nama:</label>
                <input type="text" name="nama" id="nama" value="{{ old('nama', $employee->nama) }}" class="shadow appearance-none border rounded-lg w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('nama') border-red-500 @enderror" required>
                @error('nama')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="jabatan" class="block text-gray-700 text-sm font-bold mb-2">Jabatan:</label>
                <input type="text" name="jabatan" id="jabatan" value="{{ old('jabatan', $employee->jabatan) }}" class="shadow appearance-none border rounded-lg w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('jabatan') border-red-500 @enderror">
                @error('jabatan')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="talahir" class="block text-gray-700 text-sm font-bold mb-2">Tanggal Lahir:</label>
                <input type="date" name="talahir" id="talahir" value="{{ old('talahir', $employee->talahir ? $employee->talahir->format('Y-m-d') : '') }}" class="shadow appearance-none border rounded-lg w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('talahir') border-red-500 @enderror">
                @error('talahir')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="photo" class="block text-gray-700 text-sm font-bold mb-2">Foto Saat Ini:</label>
                @if ($employee->photo_upload_path)
                    <img src="{{ $employee->photo_upload_path }}" alt="Foto {{ $employee->nama }}" class="w-32 h-32 object-cover rounded-lg shadow-sm mb-2">
                    <div class="flex items-center mb-2">
                        <input type="checkbox" name="remove_photo" id="remove_photo" class="mr-2">
                        <label for="remove_photo" class="text-gray-700 text-sm">Hapus foto ini</label>
                    </div>
                @else
                    <p class="text-gray-600 mb-2">Tidak ada foto saat ini.</p>
                @endif

                <label for="photo" class="block text-gray-700 text-sm font-bold mb-2">Unggah Foto Baru (Max 2MB, JPG, PNG, GIF):</label>
                <input type="file" name="photo" id="photo" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none @error('photo') border-red-500 @enderror">
                @error('photo')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="updated_by" class="block text-gray-700 text-sm font-bold mb-2">Diperbarui Oleh:</label>
                <input type="text" name="updated_by" id="updated_by" value="{{ old('updated_by', 'Admin') }}" class="shadow appearance-none border rounded-lg w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('updated_by') border-red-500 @enderror">
                @error('updated_by')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between">
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg focus:outline-none focus:shadow-outline transition duration-300 ease-in-out">
                    Perbarui Karyawan
                </button>
                <a href="{{ route('employees.index') }}" class="inline-block align-baseline font-bold text-sm text-blue-600 hover:text-blue-800">
                    Batal
                </a>
            </div>
        </form>
    </div>
</body>
</html>
