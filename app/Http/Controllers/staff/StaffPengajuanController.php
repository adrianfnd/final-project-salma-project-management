<?php

namespace App\Http\Controllers\staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Type;
use App\Models\Sbu;
use App\Models\Status;
use App\Models\Project;
use App\Models\Customer;
use App\Models\SuratJalan;

class StaffPengajuanController extends Controller
{
    private function generateColors()
    {
        $red = rand(100, 255);
        $green = rand(100, 255);
        $blue = rand(100, 255);

        $color = "rgba($red, $green, $blue, 0.5)";
    
        return $color;
    }

    public function index(Request $request)
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
        
        $types = Type::all();
        $sbus = Sbu::all();
        $statuses = Status::all();
      
        $pieChartData1 = [];
        $pieChartData2 = [];
        $pieChartData3 = [];

        foreach ($statuses as $status) {
            $projectsCount = $status->projects()->count();

            $pieChartData3[] = [
                'label' => $status->status_name,
                'count' => $projectsCount,
                'color' => $this->generateColors(),
            ];
        }

        foreach ($sbus as $sbu) {
            $projectsCount = $sbu->projects()->count();

            $pieChartData2[] = [
                'label' => $sbu->sbu_name,
                'count' => $projectsCount,
                'color' => $this->generateColors(),
            ];
        }
        
        foreach ($types as $type) {
            $projectsCount = $type->projects()->count();

            $pieChartData1[] = [
                'label' => $type->type_name,
                'count' => $projectsCount,
                'color' => $this->generateColors(),
            ];
        }

        $total_project = Project::whereNotIn('status_id', [Status::where('status_name', 'INSTALASI')->first()->id, Status::where('status_name', 'SURAT JALAN')->first()->id, Status::where('status_name', 'FINISHED')->first()->id])
                            ->count();

        if ($total_project > 0) {
            $inschedule_project = Project::whereNotIn('status_id', [Status::where('status_name', 'INSTALASI')->first()->id, Status::where('status_name', 'SURAT JALAN')->first()->id, Status::where('status_name', 'FINISHED')->first()->id])
                                ->whereColumn('target', '=', 'end_date')->count();
            $inschedule_project_percentage = round(($inschedule_project / $total_project) * 100);

            $overdue_project = Project::whereNotIn('status_id', [Status::where('status_name', 'INSTALASI')->first()->id, Status::where('status_name', 'SURAT JALAN')->first()->id, Status::where('status_name', 'FINISHED')->first()->id])
                                ->whereNull('end_date')
                                ->where('target', '<', now())
                                ->count();
            $overdue_project_percentage = round(($overdue_project / $total_project) * 100);

            $beyond_project = Project::whereNotIn('status_id', [Status::where('status_name', 'INSTALASI')->first()->id, Status::where('status_name', 'SURAT JALAN')->first()->id, Status::where('status_name', 'FINISHED')->first()->id])
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

        return view('staff.pengajuan.index', [
            'page_name' => $page_name,
            'projects' => $projects,
            'types' => $types,
            'sbus' => $sbus,
            'statuses' => $statuses,
            'total_project' => $total_project,
            'inschedule_project' => $inschedule_project,
            'inschedule_project_percentage' => $inschedule_project_percentage,
            'overdue_project' => $overdue_project,
            'overdue_project_percentage' => $overdue_project_percentage,
            'beyond_project' => $beyond_project,
            'beyond_project_percentage' => $beyond_project_percentage,
            'pieChartData1' => $pieChartData1,
            'pieChartData2' => $pieChartData2,
            'pieChartData3' => $pieChartData3
        ]);
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

        return view('staff.pengajuan.view', compact('page_name', 'project', 'customer', 'suratJalan'));
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

    public function create()
    {
        $page_name = 'Create Project';

        $statuses = Status::all();
        $types = Type::all();
        $sbus = Sbu::all();

        return view('staff.pengajuan.create', compact('page_name', 'statuses', 'types', 'sbus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'project_name' => 'required|string|max:255',
            'olt_hostname' => 'required|string|max:255',
            'no_sp2k_spa' => 'required|string|max:255',
            'sbu_id' => 'required|exists:sbus,id',
            'start_date' => 'required|date',
            'target' => 'required|date|after:start_date',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'radius' => 'required|numeric',
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'nullable|string|max:20',
            'customer_email' => 'nullable|email|max:255',
            'customer_address' => 'required|string',
        ], [
            'project_name.required' => 'Kolom Nama Project wajib diisi.',
            'project_name.max' => 'Kolom Nama Project tidak boleh lebih dari :max karakter.',
            'olt_hostname.required' => 'Kolom OLT Hostname wajib diisi.',
            'olt_hostname.max' => 'Kolom OLT Hostname tidak boleh lebih dari :max karakter.',
            'no_sp2k_spa.required' => 'Kolom No SP2K/SPA wajib diisi.',
            'no_sp2k_spa.max' => 'Kolom No SP2K/SPA tidak boleh lebih dari :max karakter.',
            'sbu_id.required' => 'Kolom SBU wajib diisi.',
            'sbu_id.exists' => 'SBU yang dipilih tidak valid.',
            'start_date.required' => 'Kolom Tanggal Mulai wajib diisi.',
            'start_date.date' => 'Kolom Tanggal Mulai harus berupa tanggal yang valid.',
            'target.required' => 'Kolom Target Selesai wajib diisi.',
            'target.date' => 'Kolom Target Selesai harus berupa tanggal yang valid.',
            'target.after' => 'Kolom Target Selesai harus setelah Tanggal Mulai.',
            'latitude.required' => 'Kolom Latitude wajib diisi.',
            'latitude.numeric' => 'Kolom Latitude harus berupa angka.',
            'longitude.required' => 'Kolom Longitude wajib diisi.',
            'longitude.numeric' => 'Kolom Longitude harus berupa angka.',
            'radius.required' => 'Kolom Radius (meters) wajib diisi.',
            'radius.numeric' => 'Kolom Radius (meters) harus berupa angka.',
            'customer_name.required' => 'Kolom Nama Customer wajib diisi.',
            'customer_name.max' => 'Kolom Nama Customer tidak boleh lebih dari :max karakter.',
            'customer_phone.max' => 'Kolom Nomor Telepon Customer tidak boleh lebih dari :max karakter.',
            'customer_email.max' => 'Kolom Email Customer tidak boleh lebih dari :max karakter.',
            'customer_address.required' => 'Kolom Alamat Customer wajib diisi.',
            'customer_address.max' => 'Kolom Alamat Customer tidak boleh lebih dari :max karakter.',
        ]);
        

        $project = Project::create([
            'type_id' => Type::where('type_name', 'TK4')->first()->id,
            'project_name' => 'TK-' . $request->project_name,
            'olt_hostname' => $request->olt_hostname,
            'no_sp2k_spa' => $request->no_sp2k_spa,
            'sbu_id' => $request->sbu_id,
            'status_id' => Status::where('status_name', 'PENGAJUAN')->first()->id,
            'start_date' => $request->start_date,
            'target' => $request->target,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'radius' => $request->radius,
            'progress' => 0,
            'created_by' => auth()->user()->id
        ]);

        $customer = Customer::create([
            'name' => $request->customer_name,
            'phone' => $request->customer_phone,
            'email' => $request->customer_email,
            'address' => $request->customer_address,
            'project_id' => $project->id
        ]);

        return redirect()->route('staff.pengajuan.index')->with('success', 'Project telah ditambahkan.');
    }

    public function recreate($id)
    {
        $page_name = 'Recreate Project';

        $project = Project::findOrFail($id);

        $customer = Customer::where('project_id', $project->id)
                        ->firstOrFail();

        if (!$project) {
            return redirect()->route('staff.pengajuan.index')->with('error', 'Project tidak ditemukan.');
        }

        return view('staff.pengajuan.recreate', [
            'page_name' => $page_name,
            'project' => $project,
            'customer' => $customer,
            'sbus' => Sbu::all(),
        ]);
    }

    public function restore(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:projects,id',
            'project_name' => 'required|string|max:255',
            'olt_hostname' => 'required|string|max:255',
            'no_sp2k_spa' => 'required|string|max:255',
            'sbu_id' => 'required|exists:sbus,id',
            'start_date' => 'required|date',
            'target' => 'required|date|after:start_date',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'radius' => 'required|numeric',
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'nullable|string|max:20',
            'customer_email' => 'nullable|email|max:255',
            'customer_address' => 'required|string',
        ], [
            'id.required' => 'Kolom ID Project wajib diisi.',
            'id.exists' => 'Project yang dipilih tidak valid.',
            'project_name.required' => 'Kolom Nama Project wajib diisi.',
            'project_name.max' => 'Kolom Nama Project tidak boleh lebih dari :max karakter.',
            'olt_hostname.required' => 'Kolom OLT Hostname wajib diisi.',
            'olt_hostname.max' => 'Kolom OLT Hostname tidak boleh lebih dari :max karakter.',
            'no_sp2k_spa.required' => 'Kolom No SP2K/SPA wajib diisi.',
            'no_sp2k_spa.max' => 'Kolom No SP2K/SPA tidak boleh lebih dari :max karakter.',
            'sbu_id.required' => 'Kolom SBU wajib diisi.',
            'sbu_id.exists' => 'SBU yang dipilih tidak valid.',
            'start_date.required' => 'Kolom Tanggal Mulai wajib diisi.',
            'start_date.date' => 'Kolom Tanggal Mulai harus berupa tanggal yang valid.',
            'target.required' => 'Kolom Target Selesai wajib diisi.',
            'target.date' => 'Kolom Target Selesai harus berupa tanggal yang valid.',
            'target.after' => 'Kolom Target Selesai harus setelah Tanggal Mulai.',
            'latitude.required' => 'Kolom Latitude wajib diisi.',
            'latitude.numeric' => 'Kolom Latitude harus berupa angka.',
            'longitude.required' => 'Kolom Longitude wajib diisi.',
            'longitude.numeric' => 'Kolom Longitude harus berupa angka.',
            'radius.required' => 'Kolom Radius (meters) wajib diisi.',
            'radius.numeric' => 'Kolom Radius (meters) harus berupa angka.',
            'customer_name.required' => 'Kolom Nama Customer wajib diisi.',
            'customer_name.max' => 'Kolom Nama Customer tidak boleh lebih dari :max karakter.',
            'customer_phone.max' => 'Kolom Nomor Telepon Customer tidak boleh lebih dari :max karakter.',
            'customer_email.max' => 'Kolom Email Customer tidak boleh lebih dari :max karakter.',
            'customer_address.required' => 'Kolom Alamat Customer wajib diisi.',
            'customer_address.max' => 'Kolom Alamat Customer tidak boleh lebih dari :max karakter.',
        ]);

        $existingProject = Project::find($request->id);
        
        if ($existingProject) {
            $existingCustomer = Customer::where('project_id', $existingProject->id)->first();

            if ($existingCustomer) {
                $existingSuratJalan = SuratJalan::where('project_id', $existingProject->id)->first();
                
                if ($existingSuratJalan) {
                    $existingSuratJalan->delete();
                }

                $existingCustomer->delete();
            }

            $existingProject->delete();
        }

        $project = Project::create([
            'type_id' => Type::where('type_name', 'TK4')->first()->id,
            'project_name' => 'TK-' . $request->project_name,
            'olt_hostname' => $request->olt_hostname,
            'no_sp2k_spa' => $request->no_sp2k_spa,
            'sbu_id' => $request->sbu_id,
            'status_id' => Status::where('status_name', 'PENGAJUAN')->first()->id,
            'start_date' => $request->start_date,
            'target' => $request->target,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'radius' => $request->radius,
            'progress' => 0,
            'created_by' => auth()->user()->id
        ]);

        $customer = Customer::create([
            'name' => $request->customer_name,
            'phone' => $request->customer_phone,
            'email' => $request->customer_email,
            'address' => $request->customer_address,
            'project_id' => $project->id
        ]);

        return redirect()->route('staff.pengajuan.index')->with('success', 'Project telah diperbarui.');
    }
}
