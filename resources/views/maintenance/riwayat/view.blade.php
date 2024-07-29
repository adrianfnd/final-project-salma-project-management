@extends('main')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Detail Riwayat</h4>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-12">
                                <div class="card shadow-sm">
                                    <div class="card-header bg-light">
                                        <h6 class="mb-0">Project</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <table class="table table-sm table-borderless">
                                                    <tr>
                                                        <th width="40%">Project Name</th>
                                                        <td>{{ $riwayat->project->project_name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>OLT Hostname</th>
                                                        <td>{{ $riwayat->project->olt_hostname }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>No. SP2K/SPA</th>
                                                        <td>{{ $riwayat->project->no_sp2k_spa }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>SBU</th>
                                                        <td>{{ $riwayat->project->sbu->sbu_name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Type</th>
                                                        <td>{{ $riwayat->project->type->type_name }}</td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div class="col-md-6">
                                                <table class="table table-sm table-borderless">
                                                    <tr>
                                                        <th>Status</th>
                                                        <td><span
                                                                class="badge bg-info">{{ $riwayat->project->status->status_name }}</span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Progress</th>
                                                        <td>{{ $riwayat->project->progress ?? 'N/A' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Start Date</th>
                                                        <td>{{ $riwayat->project->start_date }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Target Date</th>
                                                        <td>{{ $riwayat->project->target }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>End Date</th>
                                                        <td>{{ $riwayat->project->end_date ? $riwayat->project->end_date : 'Not Completed' }}
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-12">
                                                <h6 class="mb-2">Lokasi Project</h6>
                                                <p><strong>Latitude:</strong> {{ $riwayat->project->latitude }},
                                                    <strong>Longitude:</strong> {{ $riwayat->project->longitude }}
                                                </p>
                                                @if ($riwayat->project->radius)
                                                    <p><strong>Radius:</strong> {{ $riwayat->project->radius }}</p>
                                                @endif
                                                <div class="form-group">
                                                    <div id="mapid" style="height: 400px;"></div>
                                                </div>
                                            </div>
                                        </div>
                                        @if ($riwayat->project->kendala)
                                            <div class="row mt-3">
                                                <div class="col-12">
                                                    <h6 class="mb-2">Kendala</h6>
                                                    <p>{{ $riwayat->project->kendala }}</p>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="card shadow-sm">
                                    <div class="card-header bg-light">
                                        <h6 class="mb-0">Vendor</h6>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-sm table-borderless">
                                            <tr>
                                                <th width="30%">Name</th>
                                                <td>{{ $riwayat->vendor->name }}</td>
                                            </tr>
                                            <tr>
                                                <th>Contact Person</th>
                                                <td>{{ $riwayat->vendor->contact_person }}</td>
                                            </tr>
                                            <tr>
                                                <th>Phone</th>
                                                <td>{{ $riwayat->vendor->phone }}</td>
                                            </tr>
                                            <tr>
                                                <th>Email</th>
                                                <td>{{ $riwayat->vendor->email }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card shadow-sm">
                                    <div class="card-header bg-light">
                                        <h6 class="mb-0">Customer</h6>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-sm table-borderless">
                                            <tr>
                                                <th width="30%">Name</th>
                                                <td>{{ $riwayat->customer->name }}</td>
                                            </tr>
                                            <tr>
                                                <th>Phone</th>
                                                <td>{{ $riwayat->customer->phone }}</td>
                                            </tr>
                                            <tr>
                                                <th>Email</th>
                                                <td>{{ $riwayat->customer->email }}</td>
                                            </tr>
                                            <tr>
                                                <th>Address</th>
                                                <td>{{ $riwayat->customer->address }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if ($riwayat->suratJalan !== null && $riwayat->suratJalan->images !== null)
                            <div class="row mb-4">
                                <div class="col-md-12 mb-4">
                                    <div class="card shadow-sm">
                                        <div class="card-header bg-light">
                                            <h6 class="mb-0">Surat Jalan Check</h6>
                                        </div>
                                        <div class="card-body">
                                            <table class="table table-sm table-borderless">
                                                <tr>
                                                    <div class="form-group">
                                                        <label for="customer_address">Images</label>
                                                        <div class="row">
                                                            @foreach (json_decode($riwayat->suratJalan->images) as $image)
                                                                <div class="col-md-4 mb-3">
                                                                    <img src="{{ asset('storage/' . $image) }}"
                                                                        class="img-fluid rounded"
                                                                        style="width: 100%; height: 200px; object-fit: contain;"
                                                                        alt="Project Image">
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </tr>
                                                <tr>
                                                    <div class="form-group">
                                                        <label for="customer_address">Notes</label>
                                                        <p>{{ $riwayat->suratJalan->notes }}</p>
                                                    </div>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="row mb-4">
                            <div class="col-md-12 mb-4">
                                <div class="card shadow-sm">
                                    <div class="card-header bg-light">
                                        <h6 class="mb-0">Surat Jalan</h6>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-sm table-borderless">
                                            <tr>
                                                <th width="30%">Nomor Surat</th>
                                                <td>{{ $riwayat->suratJalan->nomor_surat }}</td>
                                            </tr>
                                            <tr>
                                                <th>Tanggal</th>
                                                <td>{{ $riwayat->tanggal }}</td>
                                            </tr>
                                            <tr>
                                                <th>Technician</th>
                                                <td>{{ $riwayat->technician->name }}</td>
                                            </tr>
                                            <tr>
                                                <div class="pdf-container">
                                                    <embed
                                                        src="{{ url('/maintenance/riwayat-pdf-' . $riwayat->project_id) }}"
                                                        type="application/pdf" width="100%" height="750px" />
                                                </div>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <div class="card shadow-sm">
                                    <div class="card-header bg-light">
                                        <h6 class="mb-0">Project Complete</h6>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-sm table-borderless">
                                            <tr>
                                                <div class="form-group">
                                                    <label for="customer_address">Images</label>
                                                    <div class="row">
                                                        @foreach (json_decode($riwayat->project->images) as $image)
                                                            <div class="col-md-4 mb-3">
                                                                <img src="{{ asset('storage/' . $image) }}"
                                                                    class="img-fluid rounded"
                                                                    style="width: 100%; height: 200px; object-fit: contain;"
                                                                    alt="Project Image">
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            @if ($riwayat->keterangan)
                                <div class="row mb-4">
                                    <div class="col-md-12">
                                        <div class="card shadow-sm">
                                            <div class="card-header bg-light">
                                                <h6 class="mb-0">Keterangan</h6>
                                            </div>
                                            <div class="card-body">
                                                <p class="mb-0">{{ $riwayat->keterangan }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-12 text-center">
                                    @if ($riwayat->suratJalan->link_file)
                                    @else
                                        <button class="btn btn-secondary" disabled>
                                            <i class="fas fa-exclamation-circle me-2"></i>Surat Jalan Not Available
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <a href="{{ route('maintenance.riwayat.index') }}" class="btn btn-light">Kembali</a>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var lat = {{ $riwayat->project->latitude }};
                var lon = {{ $riwayat->project->longitude }};
                var radius = {{ $riwayat->project->radius }};

                var map = L.map('mapid').setView([lat, lon], 13);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(map);

                var customIcon = L.icon({
                    iconUrl: '{{ asset('ui_dashboard/assets/img/map-icons/pole.png') }}',
                    iconSize: [64, 64],
                    iconAnchor: [32, 64],
                    popupAnchor: [16, -64]
                });

                var marker = L.marker([lat, lon], {
                    icon: customIcon
                }).addTo(map);

                var circle = L.circle([lat, lon], {
                    color: '#1c3782',
                    fillColor: '#aaf',
                    fillOpacity: 0.5,
                    radius: radius
                }).addTo(map);
            });
        </script>
    @endsection
