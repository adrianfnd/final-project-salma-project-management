<?php

namespace App\Http\Controllers\technician;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Type;
use App\Models\Sbu;
use App\Models\Status;
use App\Models\Customer;
use App\Models\SuratJalan;
use App\Models\RiwayatSuratJalan;
use Illuminate\Support\Facades\Storage;

class TechnicianPengajuanController extends Controller
{
    public function index(Request $request)
    {
        $page_name = 'Daftar Pengajuan Pemasangan';
        $projects = Project::where('status_id', Status::where('status_name', 'SURAT JALAN CHECK')->first()->id)
                                ->whereNotIn('status_id', [Status::where('status_name', 'INSTALASI')->first()->id, Status::where('status_name', 'SURAT JALAN')->first()->id, Status::where('status_name', 'FINISHED')->first()->id])
                                ->where('technician_id', auth()->user()->id)
                                ->get();
                                
        $selected_projects = Project::where('status_id', Status::where('status_name', 'SURAT JALAN CHECK')->first()->id)
                                ->whereNotIn('status_id', [Status::where('status_name', 'INSTALASI')->first()->id, Status::where('status_name', 'SURAT JALAN')->first()->id, Status::where('status_name', 'FINISHED')->first()->id])
                                ->where('technician_id', auth()->user()->id)
                                ->get();
        $types = Type::all();
        $sbus = Sbu::all();
        $statuses = Status::all();
      
        $total_project = Project::where('status_id', Status::where('status_name', 'SURAT JALAN CHECK')->first()->id)
                                ->whereNotIn('status_id', [Status::where('status_name', 'INSTALASI')->first()->id, Status::where('status_name', 'SURAT JALAN')->first()->id, Status::where('status_name', 'FINISHED')->first()->id])
                                ->where('technician_id', auth()->user()->id)
                                ->count();

        if ($total_project > 0) {
            $inschedule_project = Project::where('status_id', Status::where('status_name', 'SURAT JALAN CHECK')->first()->id)
                                ->whereNotIn('status_id', [Status::where('status_name', 'INSTALASI')->first()->id, Status::where('status_name', 'SURAT JALAN')->first()->id, Status::where('status_name', 'FINISHED')->first()->id])
                                ->where('technician_id', auth()->user()->id)
                                ->whereColumn('target', '=', 'end_date')->count();
            $inschedule_project_percentage = round(($inschedule_project / $total_project) * 100);

            $overdue_project = Project::where('status_id', Status::where('status_name', 'SURAT JALAN CHECK')->first()->id)
                                ->whereNotIn('status_id', [Status::where('status_name', 'INSTALASI')->first()->id, Status::where('status_name', 'SURAT JALAN')->first()->id, Status::where('status_name', 'FINISHED')->first()->id])
                                ->where('technician_id', auth()->user()->id)
                                ->whereNull('end_date')
                                ->where('target', '<', now())
                                ->count();
            $overdue_project_percentage = round(($overdue_project / $total_project) * 100);

            $beyond_project = Project::where('status_id', Status::where('status_name', 'SURAT JALAN CHECK')->first()->id)
                                ->whereNotIn('status_id', [Status::where('status_name', 'INSTALASI')->first()->id, Status::where('status_name', 'SURAT JALAN')->first()->id, Status::where('status_name', 'FINISHED')->first()->id])
                                ->where('technician_id', auth()->user()->id)
                                ->whereColumn('target', '<', 'end_date')->count();
            $beyond_project_percentage = round(($beyond_project / $total_project) * 100);
        } else {
            $inschedule_project = 0;
            $inschedule_project_percentage = 0;

            $overdue_project = 0;
            $overdue_project_percentage = 0;

            $beyond_project = 0;
            $beyond_project_percentage = 0;
        }

        return view('technician.pengajuan.index', [
            'page_name' => $page_name,
            'projects' => $projects,
            'selected_projects' => $selected_projects,
            'types' => $types,
            'sbus' => $sbus,
            'statuses' => $statuses,
            'total_project' => $total_project,
            'inschedule_project' => $inschedule_project,
            'inschedule_project_percentage' => $inschedule_project_percentage,
            'overdue_project' => $overdue_project,
            'overdue_project_percentage' => $overdue_project_percentage,
            'beyond_project' => $beyond_project,
            'beyond_project_percentage' => $beyond_project_percentage
        ]);
    }
    
    public function addToSelectedProjects(Project $project)
    {
        try {
            $suratJalan = $project->suratJalan;
            
            $suratJalan = SuratJalan::where('project_id', $project->id)->first();

            if (!$suratJalan) {
                throw new \Exception('Surat Jalan tidak ditemukan.');
            }

            $suratJalan->update(['is_active' => 'Y']);

            return response()->json(['success' => true, 'message' => 'Surat jalan berhasil ditambahkan.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function view(Project $project)
    {
        $page_name = 'View Project';

        $customer = Customer::where('project_id', $project->id)
                        ->firstOrFail();

        $project = Project::where('id', $project->id)
                        ->whereNotIn('status_id', [Status::where('status_name', 'INSTALASI')->first()->id, Status::where('status_name', 'SURAT JALAN')->first()->id, Status::where('status_name', 'FINISHED')->first()->id])
                        ->where('technician_id', auth()->user()->id)
                        ->firstOrFail();

        $suratJalan = SuratJalan::where('project_id', $project->id)
                        ->first();

        return view('technician.pengajuan.view', compact('page_name', 'project', 'customer', 'suratJalan'));
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

    public function completeView(Project $project)
    {
        $page_name = 'Complete Surat Jalan Check';

        $customer = Customer::where('project_id', $project->id)
                        ->firstOrFail();

        $project = Project::where('id', $project->id)
                        ->whereNotIn('status_id', [Status::where('status_name', 'INSTALASI')->first()->id, Status::where('status_name', 'SURAT JALAN')->first()->id, Status::where('status_name', 'FINISHED')->first()->id])
                        ->where('technician_id', auth()->user()->id)
                        ->firstOrFail();

        $suratJalan = SuratJalan::where('project_id', $project->id)
                        ->first();

        return view('technician.pengajuan.submit', compact('project', 'customer', 'suratJalan', 'page_name'));
    }

    public function complete(Request $request, Project $project)
    {
        $request->validate([
            'images.*' => 'image|mimes:jpeg,png,jpg|max:2048',
            'notes' => 'nullable|string',
        ]);
    
        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('gambar surat jalan check/' . $project->project_name, 'public');
                $imagePaths[] = $path;
            }
        }
    
        $suratJalan = SuratJalan::where('project_id', $project->id)
                        ->firstOrFail();
    
        $suratJalan->update([
            'notes' => $request->notes,
            'images' => json_encode($imagePaths),
            'is_active' => 'N',
            'updated_by' => auth()->user()->id
        ]);
    
        $project->update([
            'progress' => 50,
            'status_id' => Status::where('status_name', 'INSTALASI')->first()->id,
            'updated_by' => auth()->user()->id
        ]);
    
        return redirect()->route('technician.pengajuan.index')->with('success', 'Surat jalan check selesai.');
    }
    
}