<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function index()
    {
        $page_name = 'Vendor';

        $vendors = Vendor::paginate(10);

        return view('superadmin.vendor.index', compact('page_name', 'vendors'));
    }

    public function create()
    {
        $page_name = 'Create Vendor';

        return view('superadmin.vendor.create', compact('page_name'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'contact_person' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'address' => 'required',
        ], [
            'name.required' => 'Kolom Nama wajib diisi.',
            'contact_person.required' => 'Kolom Kontak Person wajib diisi.',
            'phone.required' => 'Kolom Telepon wajib diisi.',
            'email.required' => 'Kolom Email wajib diisi.',
            'email.email' => 'Format Email tidak valid.',
            'address.required' => 'Kolom Alamat wajib diisi.',
        ]);

        $vendor = new Vendor();
        $vendor->name = $request->name;
        $vendor->contact_person = $request->contact_person;
        $vendor->phone = $request->phone;
        $vendor->email = $request->email;
        $vendor->address = $request->address;
        $vendor->save();

        return redirect()->route('vendor.index')->with('success', 'Vendor berhasil ditambahkan');
    }

    public function edit($id)
    {
        $page_name = 'Edit Vendor';

        $vendor = Vendor::findOrFail($id);

        return view('superadmin.vendor.edit', compact('page_name', 'vendor'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'contact_person' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'address' => 'required',
        ], [
            'name.required' => 'Kolom Nama wajib diisi.',
            'contact_person.required' => 'Kolom Kontak Person wajib diisi.',
            'phone.required' => 'Kolom Telepon wajib diisi.',
            'email.required' => 'Kolom Email wajib diisi.',
            'email.email' => 'Format Email tidak valid.',
            'address.required' => 'Kolom Alamat wajib diisi.',
        ]);

        $vendor = Vendor::findOrFail($id);
        $vendor->name = $request->name;
        $vendor->contact_person = $request->contact_person;
        $vendor->phone = $request->phone;
        $vendor->email = $request->email;
        $vendor->address = $request->address;
        $vendor->save();

        return redirect()->route('vendor.index')->with('success', 'Vendor berhasil diubah');
    }

    public function destroy($id)
    {
        $vendor = Vendor::findOrFail($id);

        $vendor->delete();
        
        return redirect()->route('vendor.index')->with('success', 'Vendor berhasil dihapus');
    }
}