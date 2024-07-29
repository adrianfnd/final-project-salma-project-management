@extends('main')

@section('content')
    <div class="container-fluid py-4">
        <div class="row mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Form Edit Customer</h4>
                        <form action="{{ route('customer.update', $customer->id) }}" method="POST" class="p-4">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ old('name', $customer->name) }}" required>
                                @if ($errors->has('name'))
                                    <span class="text-danger text-sm">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Telepon</label>
                                <input type="text" class="form-control" id="phone" name="phone"
                                    value="{{ old('phone', $customer->phone) }}" required>
                                @if ($errors->has('phone'))
                                    <span class="text-danger text-sm">{{ $errors->first('phone') }}</span>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ old('email', $customer->email) }}" required>
                                @if ($errors->has('email'))
                                    <span class="text-danger text-sm">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Alamat</label>
                                <textarea class="form-control" id="address" name="address" required>{{ old('address', $customer->address) }}</textarea>
                                @if ($errors->has('address'))
                                    <span class="text-danger text-sm">{{ $errors->first('address') }}</span>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="project_id" class="form-label">Proyek</label>
                                <select class="form-control" id="project_id" name="project_id" required>
                                    <option value="">Pilih Proyek</option>
                                    @foreach ($projects as $project)
                                        <option value="{{ $project->id }}"
                                            {{ old('project_id', $customer->project_id) == $project->id ? 'selected' : '' }}>
                                            {{ $project->project_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('project_id'))
                                    <span class="text-danger text-sm">{{ $errors->first('project_id') }}</span>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-primary mr-2" style="margin-right: 10px">Update
                                Customer</button>
                            <a href="{{ route('customer.index') }}" class="btn btn-light">Batal</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
