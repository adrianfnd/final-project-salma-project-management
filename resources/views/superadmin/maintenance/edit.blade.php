@extends('main')

@section('content')
    <div class="container-fluid py-4">
        <div class="row mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Form Edit Project</h4>
                        <form action="{{ route('project.update', $project->id) }}" method="POST" class="p-4">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="project_name" class="form-label">Project Name</label>
                                <input type="text" class="form-control" id="project_name" name="project_name"
                                    value="{{ old('project_name', $project->project_name) }}" required>
                                @if ($errors->has('project_name'))
                                    <span class="text-danger text-sm">{{ $errors->first('project_name') }}</span>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="type_id" class="form-label">Project Type</label>
                                <select class="form-control" id="type_id" name="type_id" required>
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
                                <label for="olt_hostname" class="form-label">OLT Hostname</label>
                                <input type="text" class="form-control" id="olt_hostname" name="olt_hostname"
                                    value="{{ old('olt_hostname', $project->olt_hostname) }}" required>
                                @if ($errors->has('olt_hostname'))
                                    <span class="text-danger text-sm">{{ $errors->first('olt_hostname') }}</span>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="no_sp2k_spa" class="form-label">No SP2K/SPA</label>
                                <input type="text" class="form-control" id="no_sp2k_spa" name="no_sp2k_spa"
                                    value="{{ old('no_sp2k_spa', $project->no_sp2k_spa) }}" required>
                                @if ($errors->has('no_sp2k_spa'))
                                    <span class="text-danger text-sm">{{ $errors->first('no_sp2k_spa') }}</span>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="sbu_id" class="form-label">SBU</label>
                                <select class="form-control" id="sbu_id" name="sbu_id" required>
                                    @foreach ($sbus as $sbu)
                                        <option value="{{ $sbu->id }}"
                                            {{ old('sbu_id', $project->sbu_id) == $sbu->id ? 'selected' : '' }}>
                                            {{ $sbu->sbu_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('sbu_id'))
                                    <span class="text-danger text-sm">{{ $errors->first('sbu_id') }}</span>
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
                                <label for="technician_id" class="form-label">Technician</label>
                                <select class="form-control" id="technician_id" name="technician_id" required>
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
                            <button type="submit" class="btn btn-primary mr-2" style="margin-right: 10px">Update
                                Project</button>
                            <a href="{{ route('project.index') }}" class="btn btn-light">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
