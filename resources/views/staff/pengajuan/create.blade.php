@extends('main')

@section('content')
    <div class="container-fluid py-4">
        <div class="row mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Form Tambah Project</h4>
                        <form id="projectForm" class="forms-sample" method="POST"
                            action="{{ route('staff.pengajuan.store') }}">
                            @csrf

                            <div class="form-group">
                                <label for="project_name">Nama Project</label>
                                <input type="text" class="form-control" id="project_name" name="project_name"
                                    value="{{ old('project_name') }}" required>
                                @if ($errors->has('project_name'))
                                    <span class="text-danger">{{ $errors->first('project_name') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="olt_hostname">OLT Hostname</label>
                                <input type="text" class="form-control" id="olt_hostname" name="olt_hostname"
                                    value="{{ old('olt_hostname') }}" required>
                                @if ($errors->has('olt_hostname'))
                                    <span class="text-danger">{{ $errors->first('olt_hostname') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="no_sp2k_spa">No SP2K/SPA</label>
                                <input type="text" class="form-control" id="no_sp2k_spa" name="no_sp2k_spa"
                                    value="{{ old('no_sp2k_spa') }}" required>
                                @if ($errors->has('no_sp2k_spa'))
                                    <span class="text-danger">{{ $errors->first('no_sp2k_spa') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="sbu_id">SBU</label>
                                <select class="form-control" id="sbu_id" name="sbu_id" value="{{ old('sbu_id') }}"
                                    required>
                                    @foreach ($sbus as $sbu)
                                        <option value="{{ $sbu['id'] }}" data-latitude="{{ $sbu['latitude'] }}"
                                            data-longitude="{{ $sbu['longitude'] }}"
                                            {{ old('sbu_id') == $sbu['id'] ? 'selected' : '' }}>
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
                                    value="{{ old('start_date') }}" required>
                                @if ($errors->has('start_date'))
                                    <span class="text-danger">{{ $errors->first('start_date') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="target">Target Selesai</label>
                                <input type="date" class="form-control" id="target" name="target"
                                    value="{{ old('target') }}" required>
                                @if ($errors->has('target'))
                                    <span class="text-danger">{{ $errors->first('target') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="radius">Radius (meters)</label>
                                <input type="number" class="form-control" id="radius" name="radius"
                                    value="{{ old('radius', 1000) }}" required>
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
                                <input type="hidden" id="latitude" name="latitude" value="{{ old('latitude') }}"
                                    required>
                                @if ($errors->has('latitude'))
                                    <span class="text-danger">{{ $errors->first('latitude') }}</span>
                                @endif
                                <input type="hidden" id="longitude" name="longitude" value="{{ old('longitude') }}"
                                    required>
                                @if ($errors->has('longitude'))
                                    <span class="text-danger">{{ $errors->first('longitude') }}</span>
                                @endif
                            </div>

                            <h5 class="mt-4">Informasi Customer</h5>
                            <div class="form-group">
                                <label for="customer_name">Nama Customer</label>
                                <input type="text" class="form-control" id="customer_name" name="customer_name"
                                    value="{{ old('customer_name') }}" required>
                                @if ($errors->has('customer_name'))
                                    <span class="text-danger">{{ $errors->first('customer_name') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="customer_phone">Nomor Telepon Customer</label>
                                <input type="text" class="form-control" id="customer_phone" name="customer_phone"
                                    value="{{ old('customer_phone') }}">
                                @if ($errors->has('customer_phone'))
                                    <span class="text-danger">{{ $errors->first('customer_phone') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="customer_email">Email Customer</label>
                                <input type="email" class="form-control" id="customer_email" name="customer_email"
                                    value="{{ old('customer_email') }}">
                                @if ($errors->has('customer_email'))
                                    <span class="text-danger">{{ $errors->first('customer_email') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="customer_address">Alamat Customer</label>
                                <textarea class="form-control" id="customer_address" name="customer_address" rows="3" required>{{ old('customer_address') }}</textarea>
                                @if ($errors->has('customer_address'))
                                    <span class="text-danger">{{ $errors->first('customer_address') }}</span>
                                @endif
                            </div>

                            <button type="submit" class="btn btn-primary mr-2"
                                style="margin-right: 10px">Submit</button>
                            <a href="{{ route('staff.pengajuan.index') }}" class="btn btn-light">Cancel</a>
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
            var initialLat = {{ old('latitude', -2.990934) }};
            var initialLng = {{ old('longitude', 104.756555) }};
            var initialRadius = {{ old('radius', 1000) }};

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
