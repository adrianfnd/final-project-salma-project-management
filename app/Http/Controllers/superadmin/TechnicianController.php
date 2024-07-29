<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TechnicianController extends Controller
{
    public function index()
    {
        $page_name = 'Technician';

        $technicians = User::where('role_id', Role::where('role_name', 'Technician')->first()->id)->paginate(10);
        
        return view('superadmin.technician.index', compact('page_name', 'technicians'));
    }

    public function create()
    {
        $page_name = 'Create Technician';

        return view('superadmin.technician.create', compact('page_name'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ], [
            'name.required' => 'Kolom Nama wajib diisi.',
            'username.required' => 'Kolom Username wajib diisi.',
            'username.unique' => 'Username sudah digunakan.',
            'email.required' => 'Kolom Email wajib diisi.',
            'email.email' => 'Format Email tidak valid.',
            'email.unique' => 'Email sudah digunakan.',
            'password.required' => 'Kolom Password wajib diisi.',
            'password.min' => 'Password minimal harus 6 karakter.',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role_id = Role::where('role_name', 'Technician')->first()->id;
        $user->save();

        return redirect()->route('technician.index')->with('success', 'Technician berhasil ditambahkan');
    }

    public function edit($id)
    {
        $page_name = 'Edit Technician';

        $technician = User::findOrFail($id);

        return view('superadmin.technician.edit', compact('page_name', 'technician'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username,'.$id,
            'email' => 'required|email|unique:users,email,'.$id,
        ], [
            'name.required' => 'Kolom Nama wajib diisi.',
            'username.required' => 'Kolom Username wajib diisi.',
            'username.unique' => 'Username sudah digunakan.',
            'email.required' => 'Kolom Email wajib diisi.',
            'email.email' => 'Format Email tidak valid.',
            'email.unique' => 'Email sudah digunakan.',
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return redirect()->route('technician.index')->with('success', 'Technician berhasil diubah');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return redirect()->route('technician.index')->with('success', 'Technician berhasil dihapus');
    }
}