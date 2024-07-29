<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;

use App\Http\Controllers\superadmin\StaffController;
use App\Http\Controllers\superadmin\TechnicianController;
use App\Http\Controllers\superadmin\CustomerController;
use App\Http\Controllers\superadmin\MaintenanceController;
use App\Http\Controllers\superadmin\VendorController;
use App\Http\Controllers\superadmin\ProjectController;

use App\Http\Controllers\staff\StaffPengajuanController;
use App\Http\Controllers\staff\StaffRiwayatController;

use App\Http\Controllers\maintenance\MaintenancePengajuanController;
use App\Http\Controllers\maintenance\MaintenancePemasanganController;
use App\Http\Controllers\maintenance\MaintenanceRiwayatController;

use App\Http\Controllers\technician\TechnicianPengajuanController;
use App\Http\Controllers\technician\TechnicianPemasanganController;
use App\Http\Controllers\technician\TechnicianRiwayatController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Auth Route
Route::get('/', [AuthController::class, 'redirect']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.action');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'role:Superadmin'])->prefix('superadmin')->group(function () {
   Route::get('/staff', [StaffController::class, 'index'])->name('staff.index');
   Route::get('/staff/create', [StaffController::class, 'create'])->name('staff.create');
   Route::post('/staff', [StaffController::class, 'store'])->name('staff.store');
   Route::get('/staff/{id}/edit', [StaffController::class, 'edit'])->name('staff.edit');
   Route::put('/staff/{id}', [StaffController::class, 'update'])->name('staff.update');
   Route::delete('/staff/{id}', [StaffController::class, 'destroy'])->name('staff.destroy');

   Route::get('/technician', [TechnicianController::class, 'index'])->name('technician.index');
   Route::get('/technician/create', [TechnicianController::class, 'create'])->name('technician.create');
   Route::post('/technician', [TechnicianController::class, 'store'])->name('technician.store');
   Route::get('/technician/{id}/edit', [TechnicianController::class, 'edit'])->name('technician.edit');
   Route::put('/technician/{id}', [TechnicianController::class, 'update'])->name('technician.update');
   Route::delete('/technician/{id}', [TechnicianController::class, 'destroy'])->name('technician.destroy');

   Route::get('/maintenance', [MaintenanceController::class, 'index'])->name('maintenance.index');
   Route::get('/maintenance/create', [MaintenanceController::class, 'create'])->name('maintenance.create');
   Route::post('/maintenance', [MaintenanceController::class, 'store'])->name('maintenance.store');
   Route::get('/maintenance/{id}/edit', [MaintenanceController::class, 'edit'])->name('maintenance.edit');
   Route::put('/maintenance/{id}', [MaintenanceController::class, 'update'])->name('maintenance.update');
   Route::delete('/maintenance/{id}', [MaintenanceController::class, 'destroy'])->name('maintenance.destroy');

   Route::get('/vendor', [VendorController::class, 'index'])->name('vendor.index');
   Route::get('/vendor/create', [VendorController::class, 'create'])->name('vendor.create');
   Route::post('/vendor', [VendorController::class, 'store'])->name('vendor.store');
   Route::get('/vendor/{id}/edit', [VendorController::class, 'edit'])->name('vendor.edit');
   Route::put('/vendor/{id}', [VendorController::class, 'update'])->name('vendor.update');
   Route::delete('/vendor/{id}', [VendorController::class, 'destroy'])->name('vendor.destroy');
 
   Route::get('/project', [ProjectController::class, 'index'])->name('project.index');
   Route::get('/project/create', [ProjectController::class, 'create'])->name('project.create');
   Route::post('/project', [ProjectController::class, 'store'])->name('project.store');
   Route::get('/project/{id}/edit', [ProjectController::class, 'edit'])->name('project.edit');
   Route::put('/project/{id}', [ProjectController::class, 'update'])->name('project.update');
   Route::delete('/project/{id}', [ProjectController::class, 'destroy'])->name('project.destroy');
   Route::post('/project/excel', [ProjectController::class, 'showImport'])->name('project.excel');
   Route::post('/project/import', [ProjectController::class, 'importExcel'])->name('project.import');
   Route::get('/project/export', [ProjectController::class, 'export'])->name('project.export');

   Route::get('/customer', [CustomerController::class, 'index'])->name('customer.index');
   Route::get('/customer/create', [CustomerController::class, 'create'])->name('customer.create');
   Route::post('/customer', [CustomerController::class, 'store'])->name('customer.store');
   Route::get('/customer/{id}/edit', [CustomerController::class, 'edit'])->name('customer.edit');
   Route::put('/customer/{id}', [CustomerController::class, 'update'])->name('customer.update');
   Route::delete('/customer/{id}', [CustomerController::class, 'destroy'])->name('customer.destroy');
});

Route::middleware(['auth', 'role:Staff'])->prefix('staff')->group(function () {
   Route::get('/pengajuan', [StaffPengajuanController::class,'index']) -> name('staff.pengajuan.index');
   Route::get('/pengajuan/create', [StaffPengajuanController::class, 'create'])->name('staff.pengajuan.create');
   Route::post('/pengajuan', [StaffPengajuanController::class, 'store'])->name('staff.pengajuan.store');
   Route::get('/pengajuan/view-{project}', [StaffPengajuanController::class, 'view'])->name('staff.pengajuan.view');
   Route::get('/pengajuan/pdf-{id}', [StaffPengajuanController::class, 'showPdf'])->name('staff.pengajuan.pdf');
   Route::get('/pengajuan/recreate/{id}', [StaffPengajuanController::class, 'recreate'])->name('staff.pengajuan.recreate');
   Route::post('/pengajuan/restore', [StaffPengajuanController::class, 'restore'])->name('staff.pengajuan.restore');

   Route::get('/riwayat', [StaffRiwayatController::class, 'index'])->name('staff.riwayat.index');
   Route::get('/riwayat/{id}', [StaffRiwayatController::class, 'show'])->name('staff.riwayat.show');
   Route::get('/riwayat-pdf-{id}', [StaffRiwayatController::class, 'showPdf'])->name('staff.riwayat.pdf');
});

Route::middleware(['auth', 'role:Maintenance'])->prefix('maintenance')->group(function () {
   Route::get('/pengajuan', [MaintenancePengajuanController::class,'index']) -> name('maintenance.pengajuan.index');
   Route::get('/pengajuan/create-{project}', [MaintenancePengajuanController::class, 'create'])->name('maintenance.pengajuan.create');
   Route::post('/pengajuan/store-{project}', [MaintenancePengajuanController::class, 'store'])->name('maintenance.pengajuan.store');
   Route::post('/pengajuan', [MaintenancePengajuanController::class, 'store'])->name('maintenance.pengajuan.store');
   Route::get('/pengajuan/view-{project}', [MaintenancePengajuanController::class, 'view'])->name('maintenance.pengajuan.view');
   Route::get('/pengajuan/pdf-{id}', [MaintenancePengajuanController::class, 'showPdf'])->name('maintenance.pengajuan.pdf');

   Route::get('/pemasangan', [MaintenancePemasanganController::class, 'index'])->name('maintenance.pemasangan.index');
   Route::get('/pemasangan/view-{project}', [MaintenancePemasanganController::class, 'view'])->name('maintenance.pemasangan.view');
   Route::get('/pemasangan/pdf-{id}', [MaintenancePemasanganController::class, 'showPdf'])->name('maintenance.pemasangan.pdf');
   Route::post('/pemasangan/{project}/approve', [MaintenancePemasanganController::class, 'approve'])->name('maintenance.pemasangan.approve');
   Route::post('/pemasangan/{project}/decline', [MaintenancePemasanganController::class, 'decline'])->name('maintenance.pemasangan.decline');

   Route::get('/riwayat', [MaintenanceRiwayatController::class, 'index'])->name('maintenance.riwayat.index');
   Route::get('/riwayat/{id}', [MaintenanceRiwayatController::class, 'show'])->name('maintenance.riwayat.show');
   Route::get('/riwayat-pdf-{id}', [MaintenanceRiwayatController::class, 'showPdf'])->name('maintenance.riwayat.pdf');
});


Route::middleware(['auth', 'role:Technician'])->prefix('technician')->group(function () {
   Route::get('/pengajuan', [TechnicianPengajuanController::class,'index']) -> name('technician.pengajuan.index');
   Route::get('/pengajuan/create', [TechnicianPengajuanController::class, 'create'])->name('technician.engajuan.create');
   Route::post('/pengajuan', [TechnicianPengajuanController::class, 'store'])->name('technician.pengajuan.store');
   Route::get('/pengajuan/view-{project}', [TechnicianPengajuanController::class, 'view'])->name('technician.pengajuan.view');
   Route::get('/pengajuan/pdf-{id}', [TechnicianPengajuanController::class, 'showPdf'])->name('technician.pengajuan.pdf');
   Route::get('/pengajuan/{project}/complete', [TechnicianPengajuanController::class, 'completeView'])->name('technician.pengajuan.complete_view');
   Route::post('/pengajuan/{project}/complete', [TechnicianPengajuanController::class, 'complete'])->name('technician.pengajuan.complete');
   Route::post('/pengajuan/{project}/add-to-selected', [TechnicianPengajuanController::class, 'addToSelectedProjects'])->name('technician.pengajuan.add-to-selected');

   Route::get('/pemasangan', [TechnicianPemasanganController::class,'index']) -> name('technician.pemasangan.index');
   Route::get('/pemasangan/create', [TechnicianPemasanganController::class, 'create'])->name('technician.engajuan.create');
   Route::post('/pemasangan', [TechnicianPemasanganController::class, 'store'])->name('technician.pemasangan.store');
   Route::get('/pemasangan/view-{project}', [TechnicianPemasanganController::class, 'view'])->name('technician.pemasangan.view');
   Route::get('/pemasangan/pdf-{id}', [TechnicianPemasanganController::class, 'showPdf'])->name('technician.pemasangan.pdf');
   Route::get('/pemasangan/{project}/complete', [TechnicianPemasanganController::class, 'completeView'])->name('technician.pemasangan.complete_view');
   Route::post('/pemasangan/{project}/complete', [TechnicianPemasanganController::class, 'complete'])->name('technician.pemasangan.complete');
   Route::post('/pemasangan/{project}/add-to-selected', [TechnicianPemasanganController::class, 'addToSelectedProjects'])->name('technician.pemasangan.add-to-selected');
   Route::post('/pemasangan/{project}/decline', [TechnicianPemasanganController::class, 'decline'])->name('technician.pemasangan.decline');

   Route::get('/riwayat', [TechnicianRiwayatController::class, 'index'])->name('technician.riwayat.index');
   Route::get('/riwayat/{id}', [TechnicianRiwayatController::class, 'show'])->name('technician.riwayat.show');
   Route::get('/riwayat-pdf-{id}', [TechnicianRiwayatController::class, 'showPdf'])->name('technician.riwayat.pdf');
});