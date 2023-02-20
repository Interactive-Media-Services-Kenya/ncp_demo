@extends('layouts.backend')

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-home icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>{{ env('APP_NAME') }} Dashboard
                    <div class="page-title-subheading"> {{ Auth::user()->last_name }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @can('user_management_access')
        <div class="row">
            <div class="col-md-6 col-xl-4">
                <div class="card mb-3 widget-content bg-arielle-smile">

                    <div class="widget-content-wrapper text-white">
                        <a href="{{ route('admin.entries.index') }}" style="text-decoration: none; color:ghostwhite;">
                            <div class="widget-content-left">
                                <div class="widget-heading">All Entries</div>
                                <div class="widget-subheading">Total Entries</div>
                            </div>
                        </a>
                        <div class="widget-content-right">
                            <div class="widget-numbers text-white"><span>{{ number_format($entries) }}</span></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="card mb-3 widget-content bg-arielle-smile">
                    <div class="widget-content-wrapper text-white">
                        <a href="{{ route('admin.entries.valid') }}" style="text-decoration: none; color:ghostwhite;">
                            <div class="widget-content-left">
                                <div class="widget-heading">Valid Entries</div>
                                <div class="widget-subheading">Total Valid Entries</div>
                            </div>
                        </a>
                        <div class="widget-content-right">
                            <div class="widget-numbers text-white"><span>{{ number_format($entriesValid) }}</span></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="card mb-3 widget-content bg-arielle-smile">
                    <div class="widget-content-wrapper text-white">
                        <a href="{{ route('admin.entries.validpool') }}" style="text-decoration: none; color:ghostwhite;">
                            <div class="widget-content-left">
                                <div class="widget-heading">Valid Pool</div>
                                <div class="widget-subheading">Total Valid Pool</div>
                            </div>
                        </a>
                        <div class="widget-content-right">
                            <div class="widget-numbers text-white"><span>{{ number_format($validpool) }}</span></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="card mb-3 widget-content bg-grow-early">
                    <div class="widget-content-wrapper text-white">
                        <div class="widget-content-left">
                            <div class="widget-heading">Total Airtime Won</div>
                            <div class="widget-subheading">By Value</div>
                        </div>
                        <div class="widget-content-right">
                            <div class="widget-numbers text-white"><span>Ksh: {{ number_format($airtime) }}</span></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="card mb-3 widget-content bg-grow-early">
                    <div class="widget-content-wrapper text-white">
                        <div class="widget-content-left">
                            <div class="widget-heading">Airtime Won</div>
                            <div class="widget-subheading">Today</div>
                        </div>
                        <div class="widget-content-right">
                            <div class="widget-numbers text-white"><span>Ksh: {{ number_format($airtimeToday) }}</span></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="card mb-3 widget-content bg-grow-early">
                    <div class="widget-content-wrapper text-white">
                        <div class="widget-content-left">
                            <div class="widget-heading">Airtime Won</div>
                            <div class="widget-subheading">This Week</div>
                        </div>
                        <div class="widget-content-right">
                            <div class="widget-numbers text-white"><span>Ksh: {{ number_format($airtimeWeek) }}</span></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="card mb-3 widget-content bg-midnight-bloom">
                    <div class="widget-content-wrapper text-white">
                        <div class="widget-content-left">
                            <a href="{{ route('admin.draws.draw-winners-all') }}"
                                style="text-decoration: none; color:ghostwhite;">
                                <div class="widget-heading">Daily Winners</div>
                                <div class="widget-subheading">Total Daily Winners</div>
                            </a>
                        </div>
                        <div class="widget-content-right">
                            <div class="widget-numbers text-white"><span>{{ number_format($dailyWinners) }}</span></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="card mb-3 widget-content bg-midnight-bloom">
                    <div class="widget-content-wrapper text-white">
                        <div class="widget-content-left">
                            <div class="widget-heading">Today's Winners</div>
                            <div class="widget-subheading">Total Today's Winners All Prizes</div>
                        </div>
                        <div class="widget-content-right">
                            <div class="widget-numbers text-white"><span>{{ number_format($todayWinners) }}</span></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-4">
                <div class="card mb-3 widget-content bg-midnight-bloom">
                    <div class="widget-content-wrapper text-white">
                        <div class="widget-content-left">
                            <a href="{{ route('admin.draws.index') }}" style="text-decoration: none; color:ghostwhite;">
                                <div class="widget-heading">Total Draws</div>
                                <div class="widget-subheading">Draw Count</div>
                            </a>
                        </div>
                        <div class="widget-content-right">
                            <div class="widget-numbers text-white"><span>{{ number_format($draws) }}</span></div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
        <div class="row">
            <div class="col-md-12 col-lg-6">
                <div class="mb-3 card">
                    <div class="card-header-tab card-header-tab-animation card-header">
                        <div class="card-header-title">
                            <i class="header-icon lnr-apartment icon-gradient bg-love-kiss"> </i>
                            Valid Codes Vs Daily Winners ({{ \Carbon\Carbon::now()->format('F') }})
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="tabs-eg-77">
                                <div class="card mb-3 widget-chart widget-chart2 text-left w-100">
                                    <div class="widget-chat-wrapper-outer">
                                        <div class="widget-chart-wrapper widget-chart-wrapper-lg opacity-10 m-0">
                                            <canvas id="myChart"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-6">
                <div class="mb-3 card">
                    <div class="card-header-tab card-header">
                        <div class="card-header-title">
                            <i class="header-icon lnr-rocket icon-gradient bg-tempting-azure"> </i>
                            Incomming Messages Summary Per Network
                        </div>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="tab-eg-55">
                            <div class="widget-chart p-3 mb-3">
                                <canvas id="myChart-doughnut" height="330"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Chart Data For incomming messages per day this month --}}
        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-header">
                        Incomming Messages this Month:
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane fade show active">
                                <div class="card mb-3 widget-chart widget-chart2 text-left w-100">
                                    <div class="widget-chat-wrapper-outer">
                                        <div class="widget-chart-wrapper widget-chart-wrapper-lg opacity-10 m-0"
                                            style="min-height: 500px;">
                                            <canvas id="myChart-line"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 mt-3 card">
                <div class="form-group col-md-4 mt-2 align-content-right">
                    <label for="search">Search Participant Phone Number</label>
                    <input type="text" class="form-control" id="search" name="search" placeholder="Search ...2547XXXXXXXXX">
                </div>
            </div>
            <div class="main-card mb-3 card">
                <div class="card-header">User Participation

                </div>
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Phone</th>
                            <th>Message</th>
                            <th>Reply</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        //Participants Per Region
        //Region Labels
        // const data_regions = <?php echo json_encode($regions); ?>;

        const setBg = () => {
            const randomColor = "#" + Math.floor(Math.random() * 16777215).toString(16);
            return randomColor;
        }

        async function fetchDataDailyWinners() {
            const ctx = document.getElementById('myChart').getContext('2d');
            const url_lines = `{{ route('dailyWinnersVsValidEntriesThisMonth') }}`;
            let response_line_valid_entries = await fetch(url_lines);
            const res_line_valid_entries = await response_line_valid_entries.json();
            const labels_line_valid_entries = [];
            const backgroundColor_line_valid_entries = [];
            const data_stats_line_valid_entries = [];
            const data_stats_line_draw_winners = [];
            res_line_valid_entries.data.forEach(element => {
                labels_line_valid_entries.push(element.day);
                data_stats_line_valid_entries.push(element.validEntries.count);
                data_stats_line_draw_winners.push(element.dailyWinners.count);
                backgroundColor_line_valid_entries.push(setBg());
            });
            const chart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels_line_valid_entries,
                    datasets: [{
                            label: '#ValidCodes',
                            data: data_stats_line_valid_entries,
                            borderWidth: 1,
                            fill: false,
                            borderColor: false,
                            borderColor: 'red'
                        },
                        {
                            label: '#DailyWinners',
                            data: data_stats_line_draw_winners,
                            borderWidth: 1,
                            fill: false,
                            borderColor: 'green'
                        }
                    ]
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
        }


        async function fetchData() {
            //Network Incomming Doughnut
            const network_url = `{{ route('networks.incoming.stats') }}`;
            let response_network = await fetch(network_url);
            const res_network = await response_network.json();

            const labels_network = [];
            const backgroundColor_network = [];
            const data_stats_network = [];
            res_network.data.forEach(element => {
                labels_network.push(element.name);
                data_stats_network.push(element.count);
                backgroundColor_network.push(element.color);
            });
            const data_network = {
                labels: labels_network,
                datasets: [{
                    label: 'Participants Tally',
                    backgroundColor: backgroundColor_network,
                    //borderColor: ['rgb(106, 255, 51)', 'rgb(255,66,51)', 'rgb(255, 189, 51 )'],
                    data: data_stats_network,
                }]
            };
            const configDoughnut = {
                type: 'doughnut',
                data: data_network,
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                }
            };
            const myChartDoughnut = new Chart(
                document.getElementById('myChart-doughnut'),
                configDoughnut
            );


            //Networks Incoming Line Per Day this month
            const network_url_line = `{{ route('incoming.messages.perday') }}`;
            let response_network_line = await fetch(network_url_line);
            const res_network_line = await response_network_line.json();

            const labels_network_line = [];
            const backgroundColor_network_line = [];
            const data_stats_network_line = [];
            res_network_line.data.forEach(element => {
                labels_network_line.push(element.day);
                data_stats_network_line.push(element.count);
                backgroundColor_network_line.push('green');
            });
            const data_network_line = {
                labels: labels_network_line,
                datasets: [{
                    label: 'Messages Incoming Tally Per Day ({{ \Carbon\Carbon::now()->format('F') }})',
                    backgroundColor: 'green',
                    //borderColor: ['rgb(106, 255, 51)', 'rgb(255,66,51)', 'rgb(255, 189, 51 )'],
                    data: data_stats_network_line,
                }]
            };
            const configLine = {
                type: 'line',
                data: data_network_line,
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                }
            };
            const myChartLine = new Chart(
                document.getElementById('myChart-line'),
                configLine
            );

        }
        fetchDataDailyWinners();
        fetchData();


        function addData(chart, labels, data) {
            chart.data.labels.push(labels);
            chart.data.datasets.forEach((dataset) => {
                dataset.data.push(data);
            });
            chart.update();
        }

    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script type="text/javascript">

        $('#search').on('keyup', function() {
            $value = $(this).val();
            $.ajax({
                type: 'get',
                url: `{{ route('admin.search')}}`,
                data: {
                    'search': $value
                },
                success: function(data) {
                    $('tbody').html(data);
                }
            });
        })
    </script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'csrftoken': '{{ csrf_token() }}'
            }
        });
    </script>
@endsection
