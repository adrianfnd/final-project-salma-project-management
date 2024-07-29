@extends('main')

@section('content')
    <div class="container-fluid py-4">
        <div class="row mb-4">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Projects table</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="d-flex justify-content-between align-items-center px-4 pb-3">
                            <div></div>
                            <div class="d-flex justify-content-end mb-3">
                                <a href="{{ route('project.create') }}" class="btn btn-sm btn-primary" role="button"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Create project">
                                    <i class="fa fa-plus" style="margin-right: 5px; vertical-align: middle;"></i>
                                    <span style="vertical-align: middle;">Create Project</span>
                                </a>
                                <form id="excelForm" action="{{ route('project.excel') }}" style="margin-left: 5px;"
                                    method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="file" class="d-none" id="excel_file" name="excel_file"
                                        accept=".xls,.xlsx" required onchange="submitForm()">
                                    <button type="button" onclick="chooseFile()" class="btn btn-sm btn-primary">
                                        <i class="fa fa-file-excel me-1"></i>
                                        <span>Import Excel</span>
                                    </button>
                                </form>
                                <a href="{{ route('project.export') }}" class="btn btn-sm btn-primary"
                                    style="margin-left: 5px;" role="button" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Export to Excel">
                                    <i class="fa fa-download me-1"></i>
                                    <span>Export Excel</span>
                                </a>
                            </div>
                        </div>
                        <div class="table-responsive p-0">
                            <table class="table align-items-center justify-content-center mb-0">
                                <thead>
                                    <tr>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            No.</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Project Name</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Type</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            SBU</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Status</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Start</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Target</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($projects as $index => $project)
                                        <tr>
                                            <td class="align-middle text-center">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ $index + 1 }}</span>
                                            </td>
                                            <td>
                                                <div class="d-flex px-2">
                                                    <div class="my-auto">
                                                        <h6 class="mb-0 text-sm">{{ $project->project_name ?? '-' }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-sm font-weight-bold mb-0">
                                                    {{ $project->type->type_name ?? '-' }}</p>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ $project->sbu->sbu_name ?? '-' }}</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ $project->status->status_name ?? '-' }}</span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ $project->start_date ?? '-' }}</span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ $project->target ?? '-' }}</span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <a href="{{ route('project.edit', $project->id) }}"
                                                    class="btn btn-xs btn-primary btn-sm" role="button"
                                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Edit project">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button type="submit" class="btn btn-xs btn-danger btn-sm"
                                                    onclick="confirmDelete({{ $project->id }})" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="Delete project">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                                <form id="delete-form-{{ $project->id }}"
                                                    action="{{ route('project.destroy', $project->id) }}" method="POST"
                                                    style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Pagination links -->
                <div class="d-flex justify-content-end mt-4">
                    {{ $projects->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function chooseFile() {
            document.getElementById('excel_file').click();
        }

        function submitForm() {
            var fileInput = document.getElementById('excel_file');
            if (fileInput.files.length > 0) {
                document.getElementById('excelForm').submit();
            }
        }

        function confirmDelete(projectId) {
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Anda tidak akan dapat mengembalikan ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Iya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + projectId).submit();
                }
            })
        }

        var successMessage = '{{ session('success') }}';
        var errorMessage = '{{ session('error') }}';
        if (successMessage) {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: successMessage,
                showConfirmButton: false,
                timer: 2000
            });
        }

        if (errorMessage) {
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: errorMessage,
                showConfirmButton: false,
                timer: 2000
            });
        }
    </script>
@endsection
