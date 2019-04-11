@section('chartsjs')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.min.js"></script>
    <script src="/js/chart-js-config.js"></script>
@endsection
<div class="container-fluid">
                    <h1 class="dash-title">Biểu đồ</h1>
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="card spur-card">
                                <div class="card-header">
                                    <div class="spur-card-icon">
                                        <i class="fas fa-chart-bar"></i>
                                    </div>
                                    <div class="spur-card-title"> Two bars </div>
                                    <div class="spur-card-menu">
                                        <div class="dropdown show">
                                            <a class="spur-card-menu-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                                <a class="dropdown-item" href="#">Action</a>
                                                <a class="dropdown-item" href="#">Another action</a>
                                                <a class="dropdown-item" href="#">Something else here</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body spur-card-body-chart">
                                    <canvas id="spurChartjsTwoBars"></canvas>
                                    <script>
                                        var ctx = document.getElementById("spurChartjsTwoBars").getContext('2d');
                                        var myChart = new Chart(ctx, {
                                            type: 'bar',
                                            data: {
                                                labels: ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"],
                                                datasets: [{
                                                    label: 'Blue',
                                                    data: [12, 19, 3, 5, 2],
                                                    backgroundColor: window.chartColors.primary,
                                                    borderColor: 'transparent'
                                                }, {
                                                    label: 'Red',
                                                    data: [4, 12, 11, 2, 14],
                                                    backgroundColor: window.chartColors.danger,
                                                    borderColor: 'transparent'
                                                }]
                                            },
                                            options: {
                                                legend: {
                                                    display: false
                                                },
                                                scales: {
                                                    yAxes: [{
                                                        ticks: {
                                                            beginAtZero: true
                                                        }
                                                    }]
                                                }
                                            }
                                        });
                                    </script>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="card spur-card">
                                <div class="card-header">
                                    <div class="spur-card-icon">
                                        <i class="fas fa-chart-bar"></i>
                                    </div>
                                    <div class="spur-card-title"> Line </div>
                                    <div class="spur-card-menu">
                                        <div class="dropdown show">
                                            <a class="spur-card-menu-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                                <a class="dropdown-item" href="#">Action</a>
                                                <a class="dropdown-item" href="#">Another action</a>
                                                <a class="dropdown-item" href="#">Something else here</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body spur-card-body-chart">
                                    <canvas id="spurChartjsLine"></canvas>
                                    <script>
                                        var ctx = document.getElementById("spurChartjsLine").getContext('2d');
                                        var myChart = new Chart(ctx, {
                                            type: 'line',
                                            data: {
                                                labels: ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"],
                                                datasets: [{
                                                    label: 'Blue',
                                                    data: [12, 19, 3, 5, 2],
                                                    backgroundColor: window.chartColors.primary,
                                                    borderColor: window.chartColors.primary,
                                                    fill: false
                                                }, {
                                                    label: 'Red',
                                                    data: [4, 12, 11, 2, 14],
                                                    backgroundColor: window.chartColors.danger,
                                                    borderColor: window.chartColors.danger,
                                                    fill: false
                                                }]
                                            },
                                            options: {
                                                legend: {
                                                    display: false
                                                }
                                            }
                                        });
                                    </script>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="card spur-card">
                                <div class="card-header">
                                    <div class="spur-card-icon">
                                        <i class="fas fa-chart-bar"></i>
                                    </div>
                                    <div class="spur-card-title"> Doughnut </div>
                                    <div class="spur-card-menu">
                                        <div class="dropdown show">
                                            <a class="spur-card-menu-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                                <a class="dropdown-item" href="#">Action</a>
                                                <a class="dropdown-item" href="#">Another action</a>
                                                <a class="dropdown-item" href="#">Something else here</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body spur-card-body-chart">
                                    <canvas id="spurChartjsDougnut"></canvas>
                                    <script>
                                        var ctx = document.getElementById("spurChartjsDougnut").getContext('2d');
                                        var myChart = new Chart(ctx, {
                                            type: 'doughnut',
                                            data: {
                                                labels: ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"],
                                                datasets: [{
                                                    label: 'Week',
                                                    data: [12, 19, 3, 5, 2],
                                                    backgroundColor: [
                                                        window.chartColors.primary,
                                                        window.chartColors.secondary,
                                                        window.chartColors.success,
                                                        window.chartColors.superwarning,
                                                        window.chartColors.danger,
                                                    ],
                                                    borderColor: '#fff',
                                                    fill: false
                                                }]
                                            },
                                            options: {
                                                legend: {
                                                    display: false
                                                }
                                            }
                                        });
                                    </script>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="card spur-card">
                                <div class="card-header">
                                    <div class="spur-card-icon">
                                        <i class="fas fa-chart-bar"></i>
                                    </div>
                                    <div class="spur-card-title"> Polar Area </div>
                                    <div class="spur-card-menu">
                                        <div class="dropdown show">
                                            <a class="spur-card-menu-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                                <a class="dropdown-item" href="#">Action</a>
                                                <a class="dropdown-item" href="#">Another action</a>
                                                <a class="dropdown-item" href="#">Something else here</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body spur-card-body-chart">
                                    <canvas id="spurChartjsPolar"></canvas>
                                    <script>
                                        var ctx = document.getElementById("spurChartjsPolar").getContext('2d');
                                        var myChart = new Chart(ctx, {
                                            type: 'polarArea',
                                            data: {
                                                labels: ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"],
                                                datasets: [{
                                                    label: 'Week',
                                                    data: [12, 19, 3, 5, 2],
                                                    backgroundColor: [
                                                        window.chartColors.primary,
                                                        window.chartColors.secondary,
                                                        window.chartColors.success,
                                                        window.chartColors.superwarning,
                                                        window.chartColors.danger,
                                                    ],
                                                    borderColor: '#fff'
                                                }]
                                            },
                                            options: {
                                                legend: {
                                                    display: true
                                                }
                                            }
                                        });
                                    </script>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>