<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redis;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::all();
        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        return view('employees.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor' => 'required|string|max:15|unique:employees,nomor',
            'nama' => 'required|string|max:150',
            'jabatan' => 'nullable|string|max:200',
            'talahir' => 'nullable|date',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'created_by' => 'nullable|string|max:150',
        ]);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $photoPath = Storage::disk('public')->put('employees_photos', $file);
        }

        $employee = new Employee();
        $employee->nomor = $request->nomor;
        $employee->nama = $request->nama;
        $employee->jabatan = $request->jabatan;
        $employee->talahir = $request->talahir;
        $employee->photo_upload_path = $photoPath;
        $employee->created_on = now();
        $employee->created_by = $request->created_by ?? 'system';
        $employee->save();

        $this->cacheEmployee($employee);

        return redirect()->route('employees.index')->with('success', 'Karyawan berhasil ditambahkan.');
    }

    public function show(Employee $employee)
    {
        $cachedEmployee = $this->getEmployeeFromCache($employee->nomor);

        if ($cachedEmployee) {
            $employee = new Employee((array) json_decode($cachedEmployee));
            $employee->id = $employee->attributes['id'] ?? null;
        } else {
            $this->cacheEmployee($employee);
        }

        return view('employees.show', compact('employee'));
    }

    public function edit(Employee $employee)
    {
        return view('employees.edit', compact('employee'));
    }

    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'nomor' => 'required|string|max:15|unique:employees,nomor,' . $employee->id,
            'nama' => 'required|string|max:150',
            'jabatan' => 'nullable|string|max:200',
            'talahir' => 'nullable|date',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'updated_by' => 'nullable|string|max:150',
        ]);

        $photoPath = $employee->photo_upload_path;

        if ($request->hasFile('photo')) {
            if ($employee->photo_upload_path && Storage::disk('public')->exists($employee->photo_upload_path)) {
                Storage::disk('public')->delete($employee->photo_upload_path);
            }
            $file = $request->file('photo');
            $photoPath = Storage::disk('public')->put('employees_photos', $file);
        } elseif ($request->input('remove_photo')) {
            if ($employee->photo_upload_path && Storage::disk('public')->exists($employee->photo_upload_path)) {
                Storage::disk('public')->delete($employee->photo_upload_path);
            }
            $photoPath = null;
        }

        $employee->nomor = $request->nomor;
        $employee->nama = $request->nama;
        $employee->jabatan = $request->jabatan;
        $employee->talahir = $request->talahir;
        $employee->photo_upload_path = $photoPath;
        $employee->updated_on = now();
        $employee->updated_by = $request->updated_by ?? 'system';
        $employee->save();

        $this->cacheEmployee($employee);

        return redirect()->route('employees.index')->with('success', 'Karyawan berhasil diperbarui.');
    }

    public function destroy(Employee $employee)
    {
        if ($employee->photo_upload_path && Storage::disk('public')->exists($employee->photo_upload_path)) {
            Storage::disk('public')->delete($employee->photo_upload_path);
        }

        $employee->delete();
        $this->removeEmployeeFromCache($employee->nomor);

        return redirect()->route('employees.index')->with('success', 'Karyawan berhasil dihapus.');
    }

    protected function cacheEmployee(Employee $employee): void
    {
        try {
            $key = 'emp_' . $employee->nomor;
            $jsonRecord = json_encode($employee->toArray());
            Redis::set($key, $jsonRecord);
        } catch (\Exception $e) {
        }
    }

    protected function getEmployeeFromCache(string $nomor): ?string
    {
        try {
            $key = 'emp_' . $nomor;
            return Redis::get($key);
        } catch (\Exception $e) {
            return null;
        }
    }

    protected function removeEmployeeFromCache(string $nomor): void
    {
        try {
            $key = 'emp_' . $nomor;
            Redis::del($key);
        } catch (\Exception $e) {
        }
    }
}
