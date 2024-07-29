<?php

namespace App\Http\Controllers\maintenance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Vendor;
use App\Models\User;
use App\Models\SuratJalan;
use App\Models\Status;
use App\Models\Customer;
use App\Models\Role;
use Illuminate\Support\Facades\Storage;
use PDF;

class MaintenancePengajuanController extends Controller
{
    public function index()
    {
        $page_name = 'Daftar Pengajuan Pemasangan';
    
        $list_project = Project::with('status')
                ->whereNotIn('status_id', [
                    Status::where('status_name', 'INSTALASI')->first()->id,
                    Status::where('status_name', 'SURAT JALAN')->first()->id,
                    Status::where('status_name', 'FINISHED')->first()->id
                ])
                ->join('statuses', 'projects.status_id', '=', 'statuses.id')
                ->orderByRaw("CASE 
                    WHEN statuses.status_name = 'PENGAJUAN' THEN 1
                    WHEN statuses.status_name = 'SURAT JALAN CHECK' THEN 2
                    ELSE 3
                END")
                ->select('projects.*')
                ->paginate(10);

        $projects = $list_project;
    
        return view('maintenance.pengajuan.index', compact('page_name', 'projects'));
    }
    
    public function view(Project $project)
    {
        $page_name = 'View Project';

        $customer = Customer::where('project_id', $project->id)
                        ->firstOrFail();

        $project = Project::where('id', $project->id)
                        ->whereNotIn('status_id', [Status::where('status_name', 'INSTALASI')->first()->id, Status::where('status_name', 'SURAT JALAN')->first()->id, Status::where('status_name', 'FINISHED')->first()->id])
                        ->firstOrFail();

        $suratJalan = SuratJalan::where('project_id', $project->id)
                        ->first();

        return view('maintenance.pengajuan.view', compact('page_name', 'project', 'customer', 'suratJalan'));
    }

    public function showPdf($id)
    {
        $project = Project::where('id', $id)
                        ->firstOrFail();

        $suratJalan = SuratJalan::where('project_id', $project->id)
                        ->firstOrFail();
                            
        $path = str_replace('public/', 'app/public/', $suratJalan->link_file);

        $pdfPath = storage_path($path);

        if (!$pdfPath) {
            abort(404, 'PDF tidak ditemukan');
        }

        return response()->file($pdfPath);
    }

    public function create(Project $project)
    {
        $page_name = 'Create Surat Jalan';

        $project = Project::where('id', $project->id)
                        ->where('status_id', Status::where('status_name', 'PENGAJUAN')->first()->id)
                        ->firstOrFail();

        $customer = Customer::where('project_id', $project->id)->first();
        $vendors = Vendor::all();
        $technicians = User::where('role_id', Role::where('role_name', 'TECHNICIAN')->first()->id)->get();
        
        return view('maintenance.pengajuan.create', compact('page_name', 'project', 'customer', 'vendors', 'technicians'));
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'vendor_id' => 'required|exists:vendors,id',
            'technician_id' => 'required|exists:users,id',
            'deskripsi' => 'required|string',
        ], [
            'vendor_id.required' => 'Pilih vendor terlebih dahulu.',
            'technician_id.required' => 'Pilih teknisi terlebih dahulu.',
            'deskripsi.required' => 'Deskripsi wajib diisi.',
        ]);

        $project = Project::where('id', $request->project_id)
                        ->where('status_id', Status::where('status_name', 'PENGAJUAN')->first()->id)
                        ->firstOrFail();

        $project->update([
            'progress' => 25,
            'status_id' => Status::where('status_name', 'SURAT JALAN CHECK')->first()->id,
            'technician_id' => $request->technician_id,
            'updated_by' => auth()->user()->id
        ]);

        $customer = Customer::where('project_id', $project->id)->first();

        $nomor_surat = 'SJ-' . $project->project_name . '-' . $customer->customer_name . '-' . date('dmy');

        $surat_jalan = SuratJalan::create([
            'project_id' => $request->project_id,
            'vendor_id' => $request->vendor_id,
            'customer_id' => $customer->id,
            'technician_id' => $request->technician_id,
            'nomor_surat' => $nomor_surat,
            'deskripsi' => $request->deskripsi,
            'created_by' => auth()->user()->id,
        ]);

        ini_set('memory_limit', '512M');
        set_time_limit(300);

        $surat_jalan = SuratJalan::where('id', $surat_jalan->id)->first();

        $pdf = PDF::loadView('maintenance.pengajuan.pdf', compact('surat_jalan'));

        $fileName = 'surat_jalan_' . $surat_jalan->nomor_surat . '.pdf';
        $pdfPath = 'public/pengajuan/' . $project->project_name . '/' . $fileName;
        Storage::put($pdfPath, $pdf->output());

        $surat_jalan->update([
            'link_file' => $pdfPath,
            'updated_by' => auth()->user()->id
        ]);

        return redirect()->route('maintenance.pengajuan.index')->with('success', 'Surat jalan berhasil dibuat dan PDF disimpan.');
    }
}