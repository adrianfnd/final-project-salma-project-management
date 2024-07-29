@extends('main')

@section('content')
    <div class="container-fluid py-4">
        <div class="row mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Import Excel Project</h4>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if (Session::has('success'))
                            <div class="alert alert-success">
                                <a class="close" data-dismiss="alert" aria-label="close">×</a>
                                <p>{{ Session::get('success') }}</p>
                            </div>
                        @endif
                        <form action="{{ route('project.import') }}" method="post" enctype="multipart/form-data"
                            class="forms-sample">
                            @csrf
                            <div class="info mb-3">
                                @php
                                    $excelCount = $rowCount - 1;
                                @endphp
                                <p>Jumlah baris excel yang terbaca: {{ $excelCount }}</p>
                            </div>
                            <input type="hidden" name="excel_count" value="{{ $excelCount }}">
                            <input type="hidden" name="excel_data" value="{{ json_encode($excelData) }}">

                            @foreach (['project_name', 'olt_hostname', 'no_sp2k_spa', 'ip_olt', 'kendala', 'progress', 'start_date', 'target', 'end_date', 'latitude', 'longitude', 'radius'] as $field)
                                <div class="form-group">
                                    <label for="{{ $field }}">{{ ucfirst(str_replace('_', ' ', $field)) }}</label>
                                    <select name="{{ $field }}" id="{{ $field }}" class="form-control">
                                        <option value="" selected>Not Defined</option>
                                        @foreach ($excelData[0][0] as $index => $column)
                                            <option value="{{ $index + 1 }}">{{ $column }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endforeach
                            <div class="text-muted mb-3">
                                <p class="mb-1">Perhatian: </p>
                                <p class="mb-0">- Sistem hanya akan memproses lembar kerja (sheet) pertama dari berkas
                                    Excel.</p>
                                <p class="mb-1">- Baris awal pada file Excel akan dianggap sebagai judul kolom untuk
                                    seleksi.
                                    (Apabila baris pertama kosong, opsi pemilihan di bawah tidak akan menampilkan data)</p>
                            </div>

                            <button type="submit" class="btn btn-primary mr-2" style="margin-right: 10px">Import Data
                                Excel</button>
                            <a href="{{ route('project.index') }}" class="btn btn-light">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
