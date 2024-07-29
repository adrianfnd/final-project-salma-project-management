@extends('main')

@section('content')
    <div class="container-fluid py-4">
        <div class="row mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Form Edit Vendor</h4>
                        <form action="{{ route('vendor.update', $vendor->id) }}" method="POST" class="p-4">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ old('name', $vendor->name) }}" required>
                                @if ($errors->has('name'))
                                    <span class="text-danger text-sm">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="contact_person" class="form-label">Kontak Person</label>
                                <input type="text" class="form-control" id="contact_person" name="contact_person"
                                    value="{{ old('contact_person', $vendor->contact_person) }}" required>
                                @if ($errors->has('contact_person'))
                                    <span class="text-danger text-sm">{{ $errors->first('contact_person') }}</span>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Telepon</label>
                                <input type="text" class="form-control" id="phone" name="phone"
                                    value="{{ old('phone', $vendor->phone) }}" required>
                                @if ($errors->has('phone'))
                                    <span class="text-danger text-sm">{{ $errors->first('phone') }}</span>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ old('email', $vendor->email) }}" required>
                                @if ($errors->has('email'))
                                    <span class="text-danger text-sm">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Alamat</label>
                                <textarea class="form-control" id="address" name="address" required>{{ old('address', $vendor->address) }}</textarea>
                                @if ($errors->has('address'))
                                    <span class="text-danger text-sm">{{ $errors->first('address') }}</span>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-primary mr-2" style="margin-right: 10px">Update
                                Vendor</button>
                            <a href="{{ route('vendor.index') }}" class="btn btn-light">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
