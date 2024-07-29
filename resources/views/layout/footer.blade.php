{{-- FOOTER --}}
<footer class="footer pt-3">
    <div class="container-fluid">
        <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-6 mb-lg-0 mb-4">
                <div class="copyright text-center text-sm text-muted text-lg-start">
                    Project Management System
                </div>
            </div>
            <div class="col-lg-6 mb-lg-0 mb-4">
                <div class="text-center text-sm text-muted text-lg-end">
                    © 2024, All Rights Reserved.
                </div>
            </div>
        </div>
    </div>
</footer>
</div>
</main>

{{-- JS --}}
<script src="{{ asset('ui_dashboard/assets/js/core/popper.min.js') }}"></script>
<script src="{{ asset('ui_dashboard/assets/js/core/bootstrap.min.js') }}"></script>
<script src="{{ asset('ui_dashboard/assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('ui_dashboard/assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
<script src="{{ asset('ui_dashboard/assets/js/plugins/chartjs.min.js') }}"></script>

<script>
    var ctx = document.getElementById("chart-bars").getContext("2d");

    new Chart(ctx, {
        type: "bar",
        data: {
            labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            datasets: [{
                label: "Sales",
                tension: 0.4,
                borderWidth: 0,
                borderRadius: 4,
                borderSkipped: false,
                backgroundColor: "#fff",
                data: [450, 200, 100, 220, 500, 100, 400, 230, 500],
                maxBarThickness: 6
            }, ],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false,
                }
            },
            interaction: {
                intersect: false,
                mode: 'index',
            },
            scales: {
                y: {
                    grid: {
                        drawBorder: false,
                        display: false,
                        drawOnChartArea: false,
                        drawTicks: false,
                    },
                    ticks: {
                        suggestedMin: 0,
                        suggestedMax: 500,
                        beginAtZero: true,
                        padding: 15,
                        font: {
                            size: 14,
                            family: "Open Sans",
                            style: 'normal',
                            lineHeight: 2
                        },
                        color: "#fff"
                    },
                },
                x: {
                    grid: {
                        drawBorder: false,
                        display: false,
                        drawOnChartArea: false,
                        drawTicks: false
                    },
                    ticks: {
                        display: false
                    },
                },
            },
        },
    });


    var ctx2 = document.getElementById("chart-line").getContext("2d");

    var gradientStroke1 = ctx2.createLinearGradient(0, 230, 0, 50);

    gradientStroke1.addColorStop(1, 'rgba(203,12,159,0.2)');
    gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
    gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)'); //purple colors

    var gradientStroke2 = ctx2.createLinearGradient(0, 230, 0, 50);

    gradientStroke2.addColorStop(1, 'rgba(20,23,39,0.2)');
    gradientStroke2.addColorStop(0.2, 'rgba(72,72,176,0.0)');
    gradientStroke2.addColorStop(0, 'rgba(20,23,39,0)'); //purple colors

    new Chart(ctx2, {
        type: "line",
        data: {
            labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            datasets: [{
                    label: "Mobile apps",
                    tension: 0.4,
                    borderWidth: 0,
                    pointRadius: 0,
                    borderColor: "#1c3782",
                    borderWidth: 3,
                    backgroundColor: gradientStroke1,
                    fill: true,
                    data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
                    maxBarThickness: 6

                },
                {
                    label: "Websites",
                    tension: 0.4,
                    borderWidth: 0,
                    pointRadius: 0,
                    borderColor: "#3A416F",
                    borderWidth: 3,
                    backgroundColor: gradientStroke2,
                    fill: true,
                    data: [30, 90, 40, 140, 290, 290, 340, 230, 400],
                    maxBarThickness: 6
                },
            ],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false,
                }
            },
            interaction: {
                intersect: false,
                mode: 'index',
            },
            scales: {
                y: {
                    grid: {
                        drawBorder: false,
                        display: true,
                        drawOnChartArea: true,
                        drawTicks: false,
                        borderDash: [5, 5]
                    },
                    ticks: {
                        display: true,
                        padding: 10,
                        color: '#b2b9bf',
                        font: {
                            size: 11,
                            family: "Open Sans",
                            style: 'normal',
                            lineHeight: 2
                        },
                    }
                },
                x: {
                    grid: {
                        drawBorder: false,
                        display: false,
                        drawOnChartArea: false,
                        drawTicks: false,
                        borderDash: [5, 5]
                    },
                    ticks: {
                        display: true,
                        color: '#b2b9bf',
                        padding: 20,
                        font: {
                            size: 11,
                            family: "Open Sans",
                            style: 'normal',
                            lineHeight: 2
                        },
                    }
                },
            },
        },
    });
</script>
<script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
</script>
<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
<script src="{{ asset('ui_dashboard/assets/js/soft-ui-dashboard.min.js?v=1.0.7') }}"></script>

{{-- CHART FTTH --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Pie Chart
    var ctx1 = document.getElementById('chart-pie1').getContext('2d');
    var myPieChart1 = new Chart(ctx1, {
        type: 'pie',
        data: {
            labels: ["Purple", "Black", "Yellow"],
            datasets: [{
                label: '# of Votes',
                data: [12, 19, 3],
                backgroundColor: [
                    'rgba(203, 12, 159, 0.2)',
                    'rgba(20, 23, 39, 0.2)',
                    'rgba(58, 65, 111, 0.2)'
                ],
                borderColor: [
                    'rgba(203, 12, 159)',
                    'rgba(20, 23, 39)',
                    'rgba(58, 65, 111)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Bar Chart
    var ctxBar = document.getElementById('chart-bar').getContext('2d');
    var myBarChart = new Chart(ctxBar, {
        type: 'bar',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May'],
            datasets: [{
                label: 'Sales',
                data: [65, 59, 80, 81, 56],
                backgroundColor: [
                    'rgba(203, 12, 159, 0.2)',
                    'rgba(20, 23, 39, 0.2)',
                    'rgba(58, 65, 111, 0.2)',
                    'rgba(203, 12, 159, 0.2)',
                    'rgba(20, 23, 39, 0.2)'
                ],
                borderColor: [
                    'rgba(203, 12, 159, 1)',
                    'rgba(20, 23, 39, 1)',
                    'rgba(58, 65, 111, 1)',
                    'rgba(203, 12, 159, 1)',
                    'rgba(20, 23, 39, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Bar Chart
    var ctxBar2 = document.getElementById('chart-bar2').getContext('2d');
    var myBarChart = new Chart(ctxBar2, {
        type: 'bar',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May'],
            datasets: [{
                label: 'Homepass',
                data: [65, 59, 80, 81, 56],
                backgroundColor: [
                    'rgba(203, 12, 159, 0.2)',
                    'rgba(20, 23, 39, 0.2)',
                    'rgba(58, 65, 111, 0.2)',
                    'rgba(203, 12, 159, 0.2)',
                    'rgba(20, 23, 39, 0.2)'
                ],
                borderColor: [
                    'rgba(203, 12, 159, 1)',
                    'rgba(20, 23, 39, 1)',
                    'rgba(58, 65, 111, 1)',
                    'rgba(203, 12, 159, 1)',
                    'rgba(20, 23, 39, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Bar Chart
    var ctxBar3 = document.getElementById('chart-bar3').getContext('2d');
    var myBarChart = new Chart(ctxBar3, {
        type: 'bar',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May'],
            datasets: [{
                label: 'Homepass',
                data: [65, 59, 80, 81, 56],
                backgroundColor: [
                    'rgba(203, 12, 159, 0.2)',
                    'rgba(20, 23, 39, 0.2)',
                    'rgba(58, 65, 111, 0.2)',
                    'rgba(203, 12, 159, 0.2)',
                    'rgba(20, 23, 39, 0.2)'
                ],
                borderColor: [
                    'rgba(203, 12, 159, 1)',
                    'rgba(20, 23, 39, 1)',
                    'rgba(58, 65, 111, 1)',
                    'rgba(203, 12, 159, 1)',
                    'rgba(20, 23, 39, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Bar Chart
    var ctxBar4 = document.getElementById('chart-bar4').getContext('2d');
    var myBarChart = new Chart(ctxBar4, {
        type: 'bar',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May'],
            datasets: [{
                label: 'Homepass',
                data: [65, 59, 80, 81, 56],
                backgroundColor: [
                    'rgba(203, 12, 159, 0.2)',
                    'rgba(20, 23, 39, 0.2)',
                    'rgba(58, 65, 111, 0.2)',
                    'rgba(203, 12, 159, 0.2)',
                    'rgba(20, 23, 39, 0.2)'
                ],
                borderColor: [
                    'rgba(203, 12, 159, 1)',
                    'rgba(20, 23, 39, 1)',
                    'rgba(58, 65, 111, 1)',
                    'rgba(203, 12, 159, 1)',
                    'rgba(20, 23, 39, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Bar Chart
    var ctxBar5 = document.getElementById('chart-bar5').getContext('2d');
    var myBarChart = new Chart(ctxBar5, {
        type: 'bar',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May'],
            datasets: [{
                label: 'Homepass',
                data: [65, 59, 80, 81, 56],
                backgroundColor: [
                    'rgba(203, 12, 159, 0.2)',
                    'rgba(20, 23, 39, 0.2)',
                    'rgba(58, 65, 111, 0.2)',
                    'rgba(203, 12, 159, 0.2)',
                    'rgba(20, 23, 39, 0.2)'
                ],
                borderColor: [
                    'rgba(203, 12, 159, 1)',
                    'rgba(20, 23, 39, 1)',
                    'rgba(58, 65, 111, 1)',
                    'rgba(203, 12, 159, 1)',
                    'rgba(20, 23, 39, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Bar Chart
    var ctxBar6 = document.getElementById('chart-bar6').getContext('2d');
    var myBarChart = new Chart(ctxBar6, {
        type: 'bar',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May'],
            datasets: [{
                label: 'BAPS',
                data: [65, 59, 80, 81, 56],
                backgroundColor: [
                    'rgba(203, 12, 159, 0.2)',
                    'rgba(20, 23, 39, 0.2)',
                    'rgba(58, 65, 111, 0.2)',
                    'rgba(203, 12, 159, 0.2)',
                    'rgba(20, 23, 39, 0.2)'
                ],
                borderColor: [
                    'rgba(203, 12, 159, 1)',
                    'rgba(20, 23, 39, 1)',
                    'rgba(58, 65, 111, 1)',
                    'rgba(203, 12, 159, 1)',
                    'rgba(20, 23, 39, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Bar Chart
    var ctxBar7 = document.getElementById('chart-bar7').getContext('2d');
    var myBarChart = new Chart(ctxBar7, {
        type: 'bar',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May'],
            datasets: [{
                label: 'BAPS',
                data: [65, 59, 80, 81, 56],
                backgroundColor: [
                    'rgba(203, 12, 159, 0.2)',
                    'rgba(20, 23, 39, 0.2)',
                    'rgba(58, 65, 111, 0.2)',
                    'rgba(203, 12, 159, 0.2)',
                    'rgba(20, 23, 39, 0.2)'
                ],
                borderColor: [
                    'rgba(203, 12, 159, 1)',
                    'rgba(20, 23, 39, 1)',
                    'rgba(58, 65, 111, 1)',
                    'rgba(203, 12, 159, 1)',
                    'rgba(20, 23, 39, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Bar Chart
    var ctxBar8 = document.getElementById('chart-bar8').getContext('2d');
    var myBarChart = new Chart(ctxBar8, {
        type: 'bar',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May'],
            datasets: [{
                label: 'BAPS',
                data: [65, 59, 80, 81, 56],
                backgroundColor: [
                    'rgba(203, 12, 159, 0.2)',
                    'rgba(20, 23, 39, 0.2)',
                    'rgba(58, 65, 111, 0.2)',
                    'rgba(203, 12, 159, 0.2)',
                    'rgba(20, 23, 39, 0.2)'
                ],
                borderColor: [
                    'rgba(203, 12, 159, 1)',
                    'rgba(20, 23, 39, 1)',
                    'rgba(58, 65, 111, 1)',
                    'rgba(203, 12, 159, 1)',
                    'rgba(20, 23, 39, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Bar Chart
    var ctxBar9 = document.getElementById('chart-bar9').getContext('2d');
    var myBarChart = new Chart(ctxBar9, {
        type: 'bar',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May'],
            datasets: [{
                label: 'BAPS',
                data: [65, 59, 80, 81, 56],
                backgroundColor: [
                    'rgba(203, 12, 159, 0.2)',
                    'rgba(20, 23, 39, 0.2)',
                    'rgba(58, 65, 111, 0.2)',
                    'rgba(203, 12, 159, 0.2)',
                    'rgba(20, 23, 39, 0.2)'
                ],
                borderColor: [
                    'rgba(203, 12, 159, 1)',
                    'rgba(20, 23, 39, 1)',
                    'rgba(58, 65, 111, 1)',
                    'rgba(203, 12, 159, 1)',
                    'rgba(20, 23, 39, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Bar Chart
    var ctxBar10 = document.getElementById('chart-bar10').getContext('2d');
    var myBarChart = new Chart(ctxBar10, {
        type: 'bar',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May'],
            datasets: [{
                label: 'BAPS',
                data: [65, 59, 80, 81, 56],
                backgroundColor: [
                    'rgba(203, 12, 159, 0.2)',
                    'rgba(20, 23, 39, 0.2)',
                    'rgba(58, 65, 111, 0.2)',
                    'rgba(203, 12, 159, 0.2)',
                    'rgba(20, 23, 39, 0.2)'
                ],
                borderColor: [
                    'rgba(203, 12, 159, 1)',
                    'rgba(20, 23, 39, 1)',
                    'rgba(58, 65, 111, 1)',
                    'rgba(203, 12, 159, 1)',
                    'rgba(20, 23, 39, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Bar Chart
    var ctxBar11 = document.getElementById('chart-bar11').getContext('2d');
    var myBarChart = new Chart(ctxBar11, {
        type: 'bar',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May'],
            datasets: [{
                label: 'BAPS',
                data: [65, 59, 80, 81, 56],
                backgroundColor: [
                    'rgba(203, 12, 159, 0.2)',
                    'rgba(20, 23, 39, 0.2)',
                    'rgba(58, 65, 111, 0.2)',
                    'rgba(203, 12, 159, 0.2)',
                    'rgba(20, 23, 39, 0.2)'
                ],
                borderColor: [
                    'rgba(203, 12, 159, 1)',
                    'rgba(20, 23, 39, 1)',
                    'rgba(58, 65, 111, 1)',
                    'rgba(203, 12, 159, 1)',
                    'rgba(20, 23, 39, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Bar Chart
    var ctxBar12 = document.getElementById('chart-bar12').getContext('2d');
    var myBarChart = new Chart(ctxBar12, {
        type: 'bar',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May'],
            datasets: [{
                label: 'BAPS',
                data: [65, 59, 80, 81, 56],
                backgroundColor: [
                    'rgba(203, 12, 159, 0.2)',
                    'rgba(20, 23, 39, 0.2)',
                    'rgba(58, 65, 111, 0.2)',
                    'rgba(203, 12, 159, 0.2)',
                    'rgba(20, 23, 39, 0.2)'
                ],
                borderColor: [
                    'rgba(203, 12, 159, 1)',
                    'rgba(20, 23, 39, 1)',
                    'rgba(58, 65, 111, 1)',
                    'rgba(203, 12, 159, 1)',
                    'rgba(20, 23, 39, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
