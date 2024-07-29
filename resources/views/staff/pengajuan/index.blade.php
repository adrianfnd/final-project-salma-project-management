{{-- DASHBOARD PROJECT --}}

@extends('main')

@section('content')
    <div class="container-fluid py-4">
        <div class="row mb-4 justify-content-between">
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Project</p>
                                    <h5 class="font-weight-bolder mb-0">
                                        {{ $total_project }}
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                    <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">In Schedule Project</p>
                                    <h5 class="font-weight-bolder mb-0">
                                        {{ $inschedule_project }}
                                        <span class="text-success text-sm font-weight-bolder">(
                                            {{ $inschedule_project_percentage }}% of total)</span>
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                    <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Overdue Project</p>
                                    <h5 class="font-weight-bolder mb-0">
                                        {{ $overdue_project }}
                                        <span class="text-success text-sm font-weight-bolder">(
                                            {{ $overdue_project_percentage }}% of total)</span>
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                    <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Beyond Project</p>
                                    <h5 class="font-weight-bolder mb-0">
                                        {{ $beyond_project }}
                                        <span class="text-success text-sm font-weight-bolder">(
                                            {{ $beyond_project_percentage }}% of total)</span>
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                    <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-4 justify-content-between">
            <div class="col-lg-4 mb-lg-0 mb-4">
                <div class="card z-index-2">
                    <div class="card-body p-3">
                        <div class="card-body p-3 bg-white">
                            <div class="chart">
                                <canvas id="myPieChart1" class="chart-canvas" height="170"></canvas>
                            </div>
                        </div>
                        <h6 class="ms-2 mt-4 mb-0">Projects Count Per Type</h6>
                        {{-- <p class="text-sm ms-2">(<span class="font-weight-bolder">+23%</span>) than last week</p> --}}
                        <div class="container border-radius-lg">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 mb-lg-0 mb-4">
                <div class="card z-index-2">
                    <div class="card-body p-3">
                        <div class="card-body p-3 bg-white">
                            <div class="chart">
                                <canvas id="myPieChart2" class="chart-canvas" height="170"></canvas>
                            </div>
                        </div>
                        <h6 class="ms-2 mt-4 mb-0">Projects Count Per SBUS</h6>
                        {{-- <p class="text-sm ms-2">(<span class="font-weight-bolder">+23%</span>) than last week</p> --}}
                        <div class="container border-radius-lg">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card z-index-2">
                    <div class="card-body p-3">
                        <div class="card-body p-3 bg-white">
                            <div class="chart">
                                <canvas id="myPieChart3" class="chart-canvas" height="170"></canvas>
                            </div>
                        </div>
                        <h6 class="ms-2 mt-4 mb-0">Projects Count Per Status</h6>
                        {{-- <p class="text-sm ms-2">(<span class="font-weight-bolder">+23%</span>) than last week</p> --}}
                        <div class="container border-radius-lg">
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
                                <a href="{{ route('staff.pengajuan.create') }}" class="btn btn-sm btn-primary mr-2"
                                    role="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Create project">
                                    <i class="fa fa-plus" style="margin-right: 5px; vertical-align: middle;"></i>
                                    <span style="vertical-align: middle;">Create Project</span>
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
                                            Project
                                            Name</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Type</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">
                                            Progress</th>
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
                                                        <h6 class="mb-0 text-sm">{{ $project->project_name }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-sm font-weight-bold mb-0">
                                                    {{ $project->type->type_name }}
                                                </p>
                                            </td>
                                            <td class="align-middle text-center">
                                                <div class="d-flex align-items-center justify-content-center">
                                                    <span
                                                        class="me-2 text-xs font-weight-bold">{{ $project->progress }}%</span>
                                                    <div>
                                                        <div class="progress">
                                                            <div class="progress-bar bg-gradient-info" role="progressbar"
                                                                aria-valuenow="{{ $project->progress }}"
                                                                aria-valuemin="0" aria-valuemax="100"
                                                                style="width: {{ $project->progress }}%;">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ $project->status->status_name }}</span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ $project->start_date }}</span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ $project->target }}</span>
                                            </td>
                                            @if ($project->kendala === null)
                                                <td class="align-middle text-center">
                                                    <a href="{{ route('staff.pengajuan.view', $project->id) }}"
                                                        class="btn btn-xs btn-success btn-sm" role="button"
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="View project">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                </td>
                                            @else
                                                <td class="align-middle text-center">
                                                    <a href="{{ route('staff.pengajuan.recreate', $project->id) }}"
                                                        class="btn btn-xs btn-warning btn-sm" role="button"
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="Buat ulang project">
                                                        <i class="fas fa-redo-alt"></i>
                                                    </a>
                                                </td>
                                            @endif
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var ctx = document.getElementById('myPieChart1').getContext('2d');

            var pieChartData1 = @json($pieChartData1);

            var labels = pieChartData1.map(function(data) {
                return data.label;
            });

            var data = pieChartData1.map(function(data) {
                return data.count;
            });

            var backgroundColor = pieChartData1.map(function(data) {
                return data.color;
            });

            var myPieChart1 = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: labels,
                    datasets: [{
                        data: data,
                        backgroundColor: backgroundColor,
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });

        document.addEventListener("DOMContentLoaded", function() {
            var ctx = document.getElementById('myPieChart2').getContext('2d');

            var pieChartData2 = @json($pieChartData2);

            var labels = pieChartData2.map(function(data) {
                return data.label;
            });

            var data = pieChartData2.map(function(data) {
                return data.count;
            });

            var backgroundColor = pieChartData2.map(function(data) {
                return data.color;
            });

            var myPieChart2 = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: labels,
                    datasets: [{
                        data: data,
                        backgroundColor: backgroundColor,
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });

        document.addEventListener("DOMContentLoaded", function() {
            var ctx = document.getElementById('myPieChart3').getContext('2d');

            var pieChartData3 = @json($pieChartData3);

            var labels = pieChartData3.map(function(data) {
                return data.label;
            });

            var data = pieChartData3.map(function(data) {
                return data.count;
            });

            var backgroundColor = pieChartData3.map(function(data) {
                return data.color;
            });

            var myPieChart3 = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: labels,
                    datasets: [{
                        data: data,
                        backgroundColor: backgroundColor,
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
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
