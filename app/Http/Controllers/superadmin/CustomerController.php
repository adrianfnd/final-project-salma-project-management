<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Project;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $page_name = 'Customer';

        $customers = Customer::paginate(10);

        return view('superadmin.customer.index', compact('page_name', 'customers'));
    }

    public function create()
    {
        $page_name = 'Create Customer';

        $projects = Project::all();

        return view('superadmin.customer.create', compact('page_name', 'projects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'project_id' => 'required|exists:projects,id',
        ], [
            'name.required' => 'Kolom Nama wajib diisi.',
            'phone.required' => 'Kolom Telepon wajib diisi.',
            'email.required' => 'Kolom Email wajib diisi.',
            'email.email' => 'Format Email tidak valid.',
            'address.required' => 'Kolom Alamat wajib diisi.',
            'project_id.required' => 'Proyek wajib dipilih.',
        ]);

        $customer = new Customer();
        $customer->name = $request->name;
        $customer->phone = $request->phone;
        $customer->email = $request->email;
        $customer->address = $request->address;
        $customer->project_id = $request->project_id;
        $customer->save();

        return redirect()->route('customer.index')->with('success', 'Customer berhasil ditambahkan');
    }

    public function edit($id)
    {
        $page_name = 'Edit Customer';

        $customer = Customer::findOrFail($id);
        $projects = Project::all();

        return view('superadmin.customer.edit', compact('page_name', 'customer', 'projects'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'project_id' => 'required|exists:projects,id',
        ], [
            'name.required' => 'Kolom Nama wajib diisi.',
            'phone.required' => 'Kolom Telepon wajib diisi.',
            'email.required' => 'Kolom Email wajib diisi.',
            'email.email' => 'Format Email tidak valid.',
            'address.required' => 'Kolom Alamat wajib diisi.',
            'project_id.required' => 'Proyek wajib dipilih.',
        ]);

        $customer = Customer::findOrFail($id);
        $customer->name = $request->name;
        $customer->phone = $request->phone;
        $customer->email = $request->email;
        $customer->address = $request->address;
        $customer->project_id = $request->project_id;
        $customer->save();

        return redirect()->route('customer.index')->with('success', 'Customer berhasil diubah');
    }

    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);

        $customer->delete();
        
        return redirect()->route('customer.index')->with('success', 'Customer berhasil dihapus');
    }
}