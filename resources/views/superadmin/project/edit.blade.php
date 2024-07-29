@extends('main')

@section('content')
    <div class="container-fluid py-4">
        <div class="row mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Form Edit Project</h4>
                        <form action="{{ route('project.update', $project->id) }}" method="POST" class="p-4"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="project_name">Nama Project</label>
                                <input type="text" class="form-control" id="project_name" name="project_name"
                                    value="{{ old('project_name', $project->project_name) }}" required>
                                @if ($errors->has('project_name'))
                                    <span class="text-danger">{{ $errors->first('project_name') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="olt_hostname">OLT Hostname</label>
                                <input type="text" class="form-control" id="olt_hostname" name="olt_hostname"
                                    value="{{ old('olt_hostname', $project->olt_hostname) }}" required>
                                @if ($errors->has('olt_hostname'))
                                    <span class="text-danger">{{ $errors->first('olt_hostname') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="no_sp2k_spa">No SP2K/SPA</label>
                                <input type="text" class="form-control" id="no_sp2k_spa" name="no_sp2k_spa"
                                    value="{{ old('no_sp2k_spa', $project->no_sp2k_spa) }}" required>
                                @if ($errors->has('no_sp2k_spa'))
                                    <span class="text-danger">{{ $errors->first('no_sp2k_spa') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="sbu_id">SBU</label>
                                <select class="form-control" id="sbu_id" name="sbu_id" required>
                                    @foreach ($sbus as $sbu)
                                        <option value="{{ $sbu['id'] }}" data-latitude="{{ $sbu['latitude'] }}"
                                            data-longitude="{{ $sbu['longitude'] }}"
                                            {{ old('sbu_id', $project->sbu_id) == $sbu['id'] ? 'selected' : '' }}>
                                            {{ $sbu['sbu_name'] }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('sbu_id'))
                                    <span class="text-danger">{{ $errors->first('sbu_id') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="start_date">Tanggal Mulai</label>
                                <input type="date" class="form-control" id="start_date" name="start_date"
                                    value="{{ old('start_date', $project->start_date) }}" required>
                                @if ($errors->has('start_date'))
                                    <span class="text-danger">{{ $errors->first('start_date') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="target">Target Selesai</label>
                                <input type="date" class="form-control" id="target" name="target"
                                    value="{{ old('target', $project->target) }}" required>
                                @if ($errors->has('target'))
                                    <span class="text-danger">{{ $errors->first('target') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="radius">Radius (meters)</label>
                                <input type="number" class="form-control" id="radius" name="radius"
                                    value="{{ old('radius', $project->radius) }}" required>
                                @if ($errors->has('radius'))
                                    <span class="text-danger">{{ $errors->first('radius') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="mapid">Lokasi Project</label>
                                <div class="row">
                                    <div class="col-md-10">
                                        <input type="text" id="searchbox" class="form-control mb-3"
                                            placeholder="Cari lokasi">
                                    </div>
                                    <div class="col-md-2">
                                        <center>
                                            <button class="btn btn-primary" type="button" id="searchbutton">Search</button>
                                        </center>
                                    </div>
                                </div>
                                <div id="mapid" style="height: 400px;"></div>
                                <input type="hidden" id="latitude" name="latitude"
                                    value="{{ old('latitude', $project->latitude) }}" required>
                                @if ($errors->has('latitude'))
                                    <span class="text-danger">{{ $errors->first('latitude') }}</span>
                                @endif
                                <input type="hidden" id="longitude" name="longitude"
                                    value="{{ old('longitude', $project->longitude) }}" required>
                                @if ($errors->has('longitude'))
                                    <span class="text-danger">{{ $errors->first('longitude') }}</span>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="technician_id" class="form-label">Teknisi</label>
                                <select class="form-control" id="technician_id" name="technician_id" required>
                                    <option value="">Pilih Teknisi</option>
                                    @foreach ($technicians as $technician)
                                        <option value="{{ $technician->id }}"
                                            {{ old('technician_id', $project->technician_id) == $technician->id ? 'selected' : '' }}>
                                            {{ $technician->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('technician_id'))
                                    <span class="text-danger text-sm">{{ $errors->first('technician_id') }}</span>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="type_id" class="form-label">Tipe Project</label>
                                <select class="form-control" id="type_id" name="type_id" required>
                                    <option value="">Pilih Tipe Project</option>
                                    @foreach ($types as $type)
                                        <option value="{{ $type->id }}"
                                            {{ old('type_id', $project->type_id) == $type->id ? 'selected' : '' }}>
                                            {{ $type->type_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('type_id'))
                                    <span class="text-danger text-sm">{{ $errors->first('type_id') }}</span>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="kendala" class="form-label">Kendala</label>
                                <textarea class="form-control" id="kendala" name="kendala">{{ old('kendala', $project->kendala) }}</textarea>
                                @if ($errors->has('kendala'))
                                    <span class="text-danger text-sm">{{ $errors->first('kendala') }}</span>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="progress" class="form-label">Progress</label>
                                <input type="text" class="form-control" id="progress" name="progress"
                                    value="{{ old('progress', $project->progress) }}">
                                @if ($errors->has('progress'))
                                    <span class="text-danger text-sm">{{ $errors->first('progress') }}</span>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="status_id" class="form-label">Status</label>
                                <select class="form-control" id="status_id" name="status_id" required>
                                    <option value="">Pilih Status</option>
                                    @foreach ($statuses as $status)
                                        <option value="{{ $status->id }}"
                                            {{ old('status_id', $project->status_id) == $status->id ? 'selected' : '' }}>
                                            {{ $status->status_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('status_id'))
                                    <span class="text-danger text-sm">{{ $errors->first('status_id') }}</span>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="end_date" class="form-label">Tanggal Selesai</label>
                                <input type="date" class="form-control" id="end_date" name="end_date"
                                    value="{{ old('end_date', $project->end_date) }}">
                                @if ($errors->has('end_date'))
                                    <span class="text-danger text-sm">{{ $errors->first('end_date') }}</span>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="link_file" class="form-label">Upload PDF File</label>
                                <input type="file" class="form-control" id="link_file" name="link_file"
                                    accept=".pdf">
                                @if ($errors->has('link_file'))
                                    <span class="text-danger text-sm">{{ $errors->first('link_file') }}</span>
                                @endif
                                <small class="text-muted">Upload a PDF file (max 10MB)</small>
                                @if ($project->link_file)
                                    <p>Current file: {{ basename($project->link_file) }}</p>
                                    <a href="{{ asset('storage/' . $project->link_file) }}"
                                        class="btn btn-sm btn-primary" download>Download PDF</a>
                                @endif
                            </div>

                            <div class="form-group mb-3">
                                <label for="images" class="form-label">Upload Images (Format : JPG, PNG)</label>
                                <input type="file" class="form-control" id="images" name="images[]" multiple
                                    accept="image/*">
                                <small class="text-muted">Anda dapat memilih lebih dari satu gambar.</small>
                                @if ($errors->has('images'))
                                    <span class="text-danger">{{ $errors->first('images') }}</span>
                                @endif
                            </div>

                            <div id="imagePreviewContainer" class="mb-3 d-flex flex-wrap">
                                @if ($project->images)
                                    @foreach (json_decode($project->images) as $index => $image)
                                        <div class="image-preview me-2 mb-2">
                                            <img src="{{ asset('storage/' . $image) }}" alt="Project Image"
                                                style="width: 200px; height: 200px; object-fit: cover;">
                                            <input type="hidden" name="existing_images[]" value="{{ $image }}">
                                        </div>
                                    @endforeach
                                @endif
                            </div>

                            <style>
                                #imagePreviewContainer {
                                    display: flex;
                                    flex-wrap: wrap;
                                    gap: 10px;
                                }

                                .image-preview {
                                    width: 200px;
                                    height: 200px;
                                    border: 1px solid #ddd;
                                    border-radius: 4px;
                                    overflow: hidden;
                                    position: relative;
                                }

                                .image-preview img {
                                    width: 100%;
                                    height: 100%;
                                    object-fit: cover;
                                }
                            </style>

                            <div class="mb-3">
                                <label for="is_active" class="form-label">Status Aktif</label>
                                <select class="form-control" id="is_active" name="is_active" required>
                                    <option value="Y"
                                        {{ old('is_active', $project->is_active) == 'Y' ? 'selected' : '' }}>Aktif</option>
                                    <option value="N"
                                        {{ old('is_active', $project->is_active) == 'N' ? 'selected' : '' }}>Tidak Aktif
                                    </option>
                                </select>
                                @if ($errors->has('is_active'))
                                    <span class="text-danger text-sm">{{ $errors->first('is_active') }}</span>
                                @endif
                            </div>

                            <button type="submit" class="btn btn-primary mr-2" style="margin-right: 10px">Update
                                Project</button>
                            <a href="{{ route('project.index') }}" class="btn btn-light">Batal</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script>
        document.getElementById('images').addEventListener('change', function(event) {
            const previewContainer = document.getElementById('imagePreviewContainer');
            previewContainer.innerHTML = '';

            const files = event.target.files;
            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const preview = document.createElement('div');
                        preview.className = 'image-preview me-2 mb-2';
                        preview.innerHTML = `
                                                <img src="${e.target.result}" alt="Preview" style="width: 200px; height: 200px; object-fit: cover;">
                                            `;
                        previewContainer.appendChild(preview);
                    }
                    reader.readAsDataURL(file);
                }
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            var initialLat = {{ old('latitude', $project->latitude) }};
            var initialLng = {{ old('longitude', $project->longitude) }};
            var initialRadius = {{ old('radius', $project->radius) }};

            var map = L.map('mapid').setView([initialLat, initialLng], 13);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            var customIcon = L.icon({
                iconUrl: '{{ asset('ui_dashboard/assets/img/map-icons/pole.png') }}',
                iconSize: [64, 64],
                iconAnchor: [32, 64],
                popupAnchor: [16, -64]
            });

            var marker = L.marker([initialLat, initialLng], {
                draggable: true,
                icon: customIcon
            }).addTo(map);

            var circle = L.circle([initialLat, initialLng], {
                color: '#1c3782',
                fillColor: '#aaf',
                fillOpacity: 0.5,
                radius: initialRadius
            }).addTo(map);

            function updateLocationInfo(lat, lon) {
                document.getElementById('latitude').value = lat;
                document.getElementById('longitude').value = lon;

                fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lon}`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('searchbox').value = data.display_name;
                    })
                    .catch(error => console.error('Error:', error));
            }

            function updateCircleRadius(radius) {
                circle.setRadius(radius);
            }

            marker.on('dragend', function(event) {
                var position = marker.getLatLng();
                updateLocationInfo(position.lat, position.lng);
                circle.setLatLng([position.lat, position.lng]);
            });

            document.getElementById('searchbutton').addEventListener('click', function() {
                var location = document.getElementById('searchbox').value;
                fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${location}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data && data.length > 0) {
                            var lat = parseFloat(data[0].lat);
                            var lon = parseFloat(data[0].lon);
                            marker.setLatLng([lat, lon]);
                            map.setView([lat, lon], 13);
                            updateLocationInfo(lat, lon);
                            circle.setLatLng([lat, lon]);
                        } else {
                            alert('Lokasi tidak ditemukan');
                        }
                    })
                    .catch(error => console.error('Error:', error));
            });

            document.getElementById('sbu_id').addEventListener('change', function() {
                var selectedOption = this.options[this.selectedIndex];
                var lat = parseFloat(selectedOption.getAttribute('data-latitude'));
                var lon = parseFloat(selectedOption.getAttribute('data-longitude'));
                marker.setLatLng([lat, lon]);
                map.setView([lat, lon], 13);
                updateLocationInfo(lat, lon);
                circle.setLatLng([lat, lon]);
            });

            document.getElementById('radius').addEventListener('input', function() {
                var radius = parseFloat(this.value);
                updateCircleRadius(radius);
            });

            updateLocationInfo(initialLat, initialLng);
            updateCircleRadius(initialRadius);
        });
    </script>
@endsection
