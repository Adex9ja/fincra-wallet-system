@php@endphp
@extends('template')
@section('content')
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <h5 class="mb-3 mb-md-0">Welcome to Dashboard</h5>
    </div>

    <div class="row">
        <div class="col-12 col-xl-12 stretch-card">
            <div class="row flex-grow">
                <div class="col-md-4 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-baseline">
                                <h6 class="card-title mb-0">Transactions</h6>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-12">
                                    <h5 class="mb-2">{{ number_format($data['totalTransactions'], 0, '.', ',') }}</h5>
                                    <div class="d-flex align-items-baseline">
                                        <a class="text-success"
                                           href="/transactions">
                                            <span>Total Transactions</span>
                                            <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                                        </a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-baseline">
                                <h6 class="card-title mb-0">Users</h6>

                            </div>
                            <div class="row mt-2">
                                <div class="col-md-12">
                                    <h5 class="mb-2">{{ number_format($data['totalUsers'], 0, '.', ',') }}</h5>
                                    <div class="d-flex align-items-baseline">
                                        <a class="text-primary" href="/users">
                                            <span>Total Registered Users</span>
                                            <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                                        </a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-baseline">
                                <h6 class="card-title mb-0">Total Balance</h6>

                            </div>
                            <div class="row mt-2">
                                <div class="col-md-12">
                                    <h5 class="mb-2">{{ '₦ ' . number_format($data['totalBalance'], 0, '.', ',') }}</h5>
                                    <div class="d-flex align-items-baseline">
                                        <a class="text-info" href="#">
                                            <span>Available Wallet Balance</span>
                                            <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                                        </a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <h5 class="mb-3 mb-md-0">Weekly Sales Insight</h5>
        <a class="float-right btn btn-primary" href="/insight/download">Download Report</a>
    </div>

    <div class="row">
        <div class="col-12 col-xl-12 stretch-card">
            <div class="row flex-grow">
                <div class="col-md-4 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-baseline">
                                <h6 class="card-title mb-0">Total Amount</h6>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-12">
                                    <h5 class="mb-2">{{'₦ ' . number_format($sales['totalAmount'], 0) }}</h5>
                                </div>
                                <div class="d-flex align-items-baseline">
                                    <a class="text-info" href="#">
                                        <span>Week's Total Amount</span>
                                        <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-baseline">
                                <h6 class="card-title mb-0">Average Amount</h6>

                            </div>
                            <div class="row mt-2">
                                <div class="col-md-12">
                                    <h5 class="mb-2">{{ '₦ ' . number_format($sales['averageAmount'], 0) }}</h5>
                                </div>
                                <div class="d-flex align-items-baseline">
                                    <a class="text-primary" href="#">
                                        <span>Week's Average Amount</span>
                                        <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-baseline">
                                <h6 class="card-title mb-0">Total Transactions</h6>

                            </div>
                            <div class="row mt-2">
                                <div class="col-md-12">
                                    <h5 class="mb-2">{{ number_format($sales['totalTransactions'], 0) }}</h5>
                                </div>
                                <div class="d-flex align-items-baseline">
                                    <a class="text-primary" href="#">
                                        <span>Week's Total Transactions</span>
                                        <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 stretch-card">
            <div class="card">
                <div class="card-body">
                    <canvas id="reportChart2"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6 stretch-card">
            <div class="card">
                <div class="card-body">
                    <canvas id="reportChart"></canvas>
                </div>
            </div>
        </div>
    </div>

@endsection


@section('script')
    <script type="text/javascript">
        let backgrounds = [
            'rgba(255, 99, 132, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(255, 206, 86, 0.2)',
            'rgba(75, 192, 192, 0.2)',
            'rgba(153, 102, 255, 0.2)',
            'rgba(255, 159, 64, 0.2)',
            'rgba(255,239,13,0.2)',
            'rgba(1,56,157,0.2)',
            'rgba(10,255,128,0.2)',
            'rgba(184,183,192,0.2)',
            'rgba(245,255,228,0.2)',
            'rgba(255,118,168,0.2)'
        ];
        let border = [
            'rgba(255,99,132,1)',
            'rgba(54, 162, 235, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(75, 192, 192, 1)',
            'rgba(153, 102, 255, 1)',
            'rgba(255, 159, 64, 1)',
            'rgb(101,157,138)',
            'rgb(132,215,235)',
            'rgb(240,83,255)',
            'rgb(18,16,192)',
            'rgb(255,49,254)',
            'rgb(23,250,255)'
        ];

        let reportLabel = [
            @foreach ($sales['dailyStats'] as $key => $value)
                {!!  '"'. $key . '",' !!}
                @endforeach
        ];
        let reportValue = [
            @foreach ($sales['dailyStats'] as $data)
                {!!  '"'.$data['total_transactions']  . '",' !!}
                @endforeach
        ];


        new Chart(document.getElementById("reportChart").getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: reportLabel,
                datasets: [{
                    data: reportValue,
                    backgroundColor: border,
                    hoverBackgroundColor: backgrounds
                }]
            },
            options: {
                responsive: true
            }
        });
        new Chart(document.getElementById("reportChart2").getContext('2d'), {
            type: 'bar',
            data: {
                labels: reportLabel,
                datasets: [{
                    label: 'Transaction',
                    data: reportValue,
                    backgroundColor: backgrounds,
                    borderColor: border,
                    borderWidth: 1
                }]
            },
            options: {
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
@endsection
