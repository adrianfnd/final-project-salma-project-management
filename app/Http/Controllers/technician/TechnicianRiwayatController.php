<?php

namespace App\Http\Controllers\technician;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RiwayatSuratJalan;
use App\Models\Project;
use App\Models\SuratJalan;

class TechnicianRiwayatController extends Controller
{
    public function index()
    {
        $page_name = 'Riwayat';
        
        $riwayatSuratJalans = RiwayatSuratJalan::with(['suratJalan', 'project', 'technician', 'vendor', 'customer', 'creator'])
                    ->where('technician_id', auth()->user()->id)
                    ->orderBy('created_at', 'desc')
                    ->paginate(10);

        return view('technician.riwayat.index', compact('page_name', 'riwayatSuratJalans'));
    }

    public function show($id)
    {
        $page_name = 'View Riwayat';

        $riwayat = RiwayatSuratJalan::with(['suratJalan', 'project', 'technician', 'vendor', 'customer', 'creator'])
                    ->where('technician_id', auth()->user()->id)
                    ->findOrFail($id);

        return view('technician.riwayat.view', compact('page_name', 'riwayat'));
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
}