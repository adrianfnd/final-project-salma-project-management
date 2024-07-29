<?php

namespace App\Http\Controllers\maintenance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\SuratJalan;
use App\Models\Status;
use App\Models\Customer;
use App\Models\Role;
use Illuminate\Support\Facades\Storage;
use PDF;

class MaintenancePemasanganController extends Controller
{
    public function index()
    {
        $page_name = 'Daftar Pemasangan';

        $excludedStatuses = ['PENGAJUAN', 'SURAT JALAN CHECK', 'FINISHED'];
        $excludedStatusIds = Status::whereIn('status_name', $excludedStatuses)->pluck('id');
        
        $list_project = Project::with('status')
            ->whereNotIn('status_id', $excludedStatusIds)
            ->join('statuses', 'projects.status_id', '=', 'statuses.id')
            ->orderByRaw("CASE 
                WHEN statuses.status_name = 'INSTALASI' THEN 1
                WHEN statuses.status_name = 'SURAT JALAN' THEN 2
                ELSE 3
            END")
            ->select('projects.*')
            ->paginate(10);
        
        $projects = $list_project;
        
        return view('maintenance.pemasangan.index', compact('page_name', 'projects'));
    }

    public function view(Project $project)
    {
        $page_name = 'View Project';

        $customer = Customer::where('project_id', $project->id)
                        ->firstOrFail();

        $project = Project::where('id', $project->id)
                        ->whereNotIn('status_id', [Status::where('status_name', 'PENGAJUAN')->first()->id, Status::where('status_name', 'SURAT JALAN CHECK')->first()->id, Status::where('status_name', 'FINISHED')->first()->id])
                        ->firstOrFail();

        $suratJalan = SuratJalan::where('project_id', $project->id)
                        ->first();

        return view('maintenance.pemasangan.view', compact('page_name', 'project', 'customer', 'suratJalan'));
    }

    public function showPdf($id)
    {
        $project = Project::where('id', $id)
                        ->firstOrFail();
                            
        $path = str_replace('public/', 'app/public/', $project->link_file);

        $pdfPath = storage_path($path);

        if (!$pdfPath) {
            abort(404, 'PDF tidak ditemukan');
        }

        return response()->file($pdfPath);
    }


    public function approve(Project $project)
    {
        if ($project->status->status_name !== 'INSTALASI') {
            return response()->json(['error' => 'Project tidak ditemukan.'], 400);
        }

        $surat_jalan = SuratJalan::where('project_id', $project->id)->firstOrFail();


        $project->update([
            'progress' => 75,
            'status_id' => Status::where('status_name', 'SURAT JALAN')->first()->id,
            'link_file' => $surat_jalan->link_file,
            'updated_by' => auth()->user()->id
        ]);
    
        return response()->json(['message' => 'Project disetujui dan Surat Jalan dibuat.']);
    }
    
    public function decline(Request $request, Project $project)
    {
        if ($project->status->status_name !== 'INSTALASI') {
            return response()->json(['error' => 'Project tidak ditemukan.'], 400);
        }
    
        $project->update([
            'kendala' => $request->notes,
            'progress' => 0,
            'status_id' => Status::where('status_name', 'PENGAJUAN')->first()->id,
            'updated_by' => auth()->user()->id
        ]);

        $suratJalan = SuratJalan::where('project_id', $project->id)->first();
    
        if ($suratJalan) {
            if ($suratJalan->link_file) {
                Storage::delete($suratJalan->link_file);
            }

            $suratJalan->delete();
        }
    
        return response()->json(['message' => 'Project ditolak.']);
    }

}