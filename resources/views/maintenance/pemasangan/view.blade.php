@extends('main')

@section('content')
    <div class="container-fluid py-4">
        <div class="row mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Detail Project</h4>
                        @if ($project->project_name)
                            <div class="form-group">
                                <label for="project_name">Nama Project</label>
                                <p>{{ $project->project_name }}</p>
                            </div>
                        @endif
                        @if ($project->olt_hostname)
                            <div class="form-group">
                                <label for="olt_hostname">OLT Hostname</label>
                                <p>{{ $project->olt_hostname }}</p>
                            </div>
                        @endif
                        @if ($project->no_sp2k_spa)
                            <div class="form-group">
                                <label for="no_sp2k_spa">No SP2K/SPA</label>
                                <p>{{ $project->no_sp2k_spa }}</p>
                            </div>
                        @endif
                        @if ($project->sbu_id)
                            <div class="form-group">
                                <label for="sbu_id">SBU</label>
                                <p>{{ $project->sbu->sbu_name }}</p>
                            </div>
                        @endif
                        @if ($project->hp_plan)
                            <div class="form-group">
                                <label for="hp_plan">HP Plan</label>
                                <p>{{ $project->hp_plan }}</p>
                            </div>
                        @endif
                        @if ($project->hp_built)
                            <div class="form-group">
                                <label for="hp_built">HP Built</label>
                                <p>{{ $project->hp_built }}</p>
                            </div>
                        @endif
                        @if ($project->fat_total)
                            <div class="form-group">
                                <label for="fat_total">FAT Total</label>
                                <p>{{ $project->fat_total }}</p>
                            </div>
                        @endif
                        @if ($project->fat_progress)
                            <div class="form-group">
                                <label for="fat_progress">FAT Progress</label>
                                <p>{{ $project->fat_progress }}</p>
                            </div>
                        @endif
                        @if ($project->fat_built)
                            <div class="form-group">
                                <label for="fat_built">FAT Built</label>
                                <p>{{ $project->fat_built }}</p>
                            </div>
                        @endif
                        @if ($project->ip_olt)
                            <div class="form-group">
                                <label for="ip_olt">IP OLT</label>
                                <p>{{ $project->ip_olt }}</p>
                            </div>
                        @endif
                        @if ($project->kendala)
                            <div class="form-group">
                                <label for="kendala">Kendala</label>
                                <p>{{ $project->kendala }}</p>
                            </div>
                        @endif
                        @if ($project->progress)
                            <div class="form-group">
                                <label for="progress">Progress</label>
                                <p>{{ $project->progress }}</p>
                            </div>
                        @endif
                        @if ($project->status_id)
                            <div class="form-group">
                                <label for="status_id">Status</label>
                                <p>{{ $project->status->status_name }}</p>
                            </div>
                        @endif
                        @if ($project->start_date)
                            <div class="form-group">
                                <label for="start_date">Tanggal Mulai</label>
                                <p>{{ $project->start_date }}</p>
                            </div>
                        @endif
                        @if ($project->target)
                            <div class="form-group">
                                <label for="target">Target Selesai</label>
                                <p>{{ $project->target }}</p>
                            </div>
                        @endif
                        @if ($project->end_date)
                            <div class="form-group">
                                <label for="end_date">Tanggal Selesai</label>
                                <p>{{ $project->end_date }}</p>
                            </div>
                        @endif
                        @if ($project->radius)
                            <div class="form-group">
                                <label for="radius">Radius (meters)</label>
                                <p>{{ $project->radius }}</p>
                            </div>
                        @endif
                        <div class="form-group">
                            <label for="mapid">Lokasi Project</label>
                            <div id="mapid" style="height: 400px;"></div>
                        </div>
                        <h5 class="mt-4">Informasi Customer</h5>
                        @if ($customer->name)
                            <div class="form-group">
                                <label for="customer_name">Nama Customer</label>
                                <p>{{ $customer->name }}</p>
                            </div>
                        @endif
                        @if ($customer->phone)
                            <div class="form-group">
                                <label for="customer_phone">Nomor Telepon Customer</label>
                                <p>{{ $customer->phone }}</p>
                            </div>
                        @endif
                        @if ($customer->email)
                            <div class="form-group">
                                <label for="customer_email">Email Customer</label>
                                <p>{{ $customer->email }}</p>
                            </div>
                        @endif
                        @if ($customer->address)
                            <div class="form-group">
                                <label for="customer_address">Alamat Customer</label>
                                <p>{{ $customer->address }}</p>
                            </div>
                        @endif

                        @if ($suratJalan !== null && $suratJalan->images !== null)
                            <h5 class="mt-4">Surat Jalan Check</h5>

                            <div class="form-group">
                                <label for="customer_address">Images</label>
                                <div class="row">
                                    @foreach (json_decode($suratJalan->images) as $image)
                                        <div class="col-md-4 mb-3">
                                            <img src="{{ asset('storage/' . $image) }}" class="img-fluid rounded"
                                                style="width: 100%; height: 200px; object-fit: contain;"
                                                alt="Project Image">
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="customer_address">Notes</label>
                                <p>{{ $suratJalan->notes }}</p>
                            </div>
                        @endif

                        @if ($project->link_file !== null)
                            <h5 class="mt-4">Surat Jalan</h5>
                            <div class="pdf-container">
                                <embed src="{{ url('/maintenance/pemasangan/pdf-' . $project->id) }}"
                                    type="application/pdf" width="100%" height="750px" />
                            </div>
                        @endif

                        <a href="{{ route('maintenance.pemasangan.index') }}" class="btn btn-light">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var lat = {{ $project->latitude }};
            var lon = {{ $project->longitude }};
            var radius = {{ $project->radius }};

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
