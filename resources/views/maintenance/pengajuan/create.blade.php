@extends('main')

@section('content')
    <div class="container-fluid py-4">
        <div class="row mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Form Buat Surat Jalan</h4>
                        <form class="forms-sample" method="POST" action="{{ route('maintenance.pengajuan.store') }}">
                            @csrf
                            <input type="hidden" name="project_id" value="{{ $project->id }}">

                            <div id="project-details">
                                <h5>Project Details</h5>
                                <p><strong>Name:</strong> {{ $project->project_name }}</p>
                                <p><strong>OLT Hostname:</strong> {{ $project->olt_hostname }}</p>
                                <p><strong>No SP2K/SPA:</strong> {{ $project->no_sp2k_spa }}</p>
                                <p><strong>Start Date:</strong> {{ $project->start_date }}</p>
                                <p><strong>End Date:</strong> {{ $project->end_date }}</p>
                            </div>

                            <div class="form-group">
                                <label for="mapid">Lokasi Project</label>
                                <div id="mapid" style="height: 400px;"></div>
                            </div>

                            <div class="form-group">
                                <label for="vendor_id">Vendor</label>
                                <select class="form-control" id="vendor_id" name="vendor_id" required>
                                    <option value="">Pilih Vendor</option>
                                    @foreach ($vendors as $vendor)
                                        <option value="{{ $vendor->id }}" data-name="{{ $vendor->name }}"
                                            data-contact="{{ $vendor->contact_person }}" data-phone="{{ $vendor->phone }}"
                                            data-email="{{ $vendor->email }}">
                                            {{ $vendor->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('vendor_id'))
                                    <span class="text-danger">{{ $errors->first('vendor_id') }}</span>
                                @endif
                            </div>

                            <div id="vendor-details" style="display: none;">
                                <h5>Vendor Details</h5>
                                <p><strong>Name:</strong> <span id="vendor-name"></span></p>
                                <p><strong>Contact Person:</strong> <span id="vendor-contact"></span></p>
                                <p><strong>Phone:</strong> <span id="vendor-phone"></span></p>
                                <p><strong>Email:</strong> <span id="vendor-email"></span></p>
                            </div>

                            <div class="form-group">
                                <label for="technician_id">Teknisi</label>
                                <select class="form-control" id="technician_id" name="technician_id" required>
                                    <option value="">Pilih Teknisi</option>
                                    @foreach ($technicians as $technician)
                                        <option value="{{ $technician->id }}" data-name="{{ $technician->name }}"
                                            data-email="{{ $technician->email }}">
                                            {{ $technician->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('technician_id'))
                                    <span class="text-danger">{{ $errors->first('technician_id') }}</span>
                                @endif
                            </div>

                            <div id="technician-details" style="display: none;">
                                <h5>Technician Details</h5>
                                <p><strong>Name:</strong> <span id="technician-name"></span></p>
                                <p><strong>Email:</strong> <span id="technician-email"></span></p>
                            </div>

                            <div class="form-group">
                                <label for="deskripsi">Deskripsi</label>
                                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" required></textarea>
                                @if ($errors->has('deskripsi'))
                                    <span class="text-danger">{{ $errors->first('deskripsi') }}</span>
                                @endif
                            </div>

                            <button type="submit" class="btn btn-primary mr-2" style="margin-right: 10px">Submit</button>
                            <a href="{{ route('maintenance.pengajuan.index') }}" class="btn btn-light">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const vendorSelect = document.getElementById('vendor_id');
            const technicianSelect = document.getElementById('technician_id');
            let map, marker, circle;

            function initMap(lat, lon, radius) {
                map = L.map('mapid').setView([lat, lon], 13);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(map);

                var customIcon = L.icon({
                    iconUrl: '{{ asset('ui_dashboard/assets/img/map-icons/pole.png') }}',
                    iconSize: [64, 64],
                    iconAnchor: [32, 64],
                    popupAnchor: [16, -64]
                });

                marker = L.marker([lat, lon], {
                    icon: customIcon
                }).addTo(map);

                circle = L.circle([lat, lon], {
                    color: '#1c3782',
                    fillColor: '#aaf',
                    fillOpacity: 0.5,
                    radius: radius
                }).addTo(map);
            }

            vendorSelect.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                document.getElementById('vendor-name').textContent = selectedOption.dataset.name;
                document.getElementById('vendor-contact').textContent = selectedOption.dataset.contact;
                document.getElementById('vendor-phone').textContent = selectedOption.dataset.phone;
                document.getElementById('vendor-email').textContent = selectedOption.dataset.email;
                document.getElementById('vendor-details').style.display = 'block';
            });

            technicianSelect.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                document.getElementById('technician-name').textContent = selectedOption.dataset.name;
                document.getElementById('technician-email').textContent = selectedOption.dataset.email;
                document.getElementById('technician-details').style.display = 'block';
            });

            initMap({{ $project->latitude }}, {{ $project->longitude }}, {{ $project->radius }});
        });
    </script>
@endsection
