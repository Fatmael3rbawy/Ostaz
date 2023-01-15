@extends('web.layouts.base')
@section('content')
    <div class="container">
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-lg-12 position-relative z-index-2">
                    <div class="card card-plain mb-4">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="d-flex flex-column h-100">
                                        <h2 class="font-weight-bolder mb-0">General Statistics</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card ">
                                <div class="card-body p-3">
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="numbers">
                                                <p class="text-sm mb-0 text-capitalize font-weight-bold"> Instructors</p>
                                                <h5 class="font-weight-bolder mb-0">
                                                    {{ $instructors }}
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="col-4 text-end">
                                            <div
                                                class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                                <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 mt-sm-0 mt-4">
                            <div class="card  mb-4">
                                <div class="card-body p-3">
                                    <div class="row">
                                        <div class="col-8">
                                            <div class="numbers">
                                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Users</p>
                                                <h5 class="font-weight-bolder mb-0">
                                                    {{ $users }}
                                                    {{-- <span class="text-danger text-sm font-weight-bolder">-2%</span> --}}
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="col-4 text-end">
                                            <div
                                                class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                                <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 mt-sm-0 mt-4">
                            <div class="card  mb-4">
                                <div class="card-body p-3">
                                    <div class="row">
                                        <div class="col-8">
                                            <div class="numbers">
                                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Employees</p>
                                                <h5 class="font-weight-bolder mb-0">
                                                    {{ $employees }}
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="col-4 text-end">
                                            <div
                                                class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                                <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-lg-6 position-relative z-index-2">

                    <canvas id="CategoryChart"></canvas>
                </div>
                <div class="col-lg-6 position-relative z-index-2">
                    <canvas id="CityChart"></canvas>
                </div>
            </div>
        </div>

    </div>
    
    @include('web.pages.home.partials.scripts')

    @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script type="text/javascript">
            var labels = {{ Js::from($category_labels) }};
            var users = {{ Js::from($category_data) }};

            const data = {
                labels: labels,
                datasets: [{
                    backgroundColor: [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                        'rgb(255, 205, 86)',
                        'rgb(255, 105, 86)',
                        'rgb(22, 205, 32)',
                    ],
                    data: users,
                }]
            };

            const config = {
                type: 'pie',
                data: data,
                options: {}
            };

            const myChart = new Chart(
                document.getElementById('CategoryChart'),
                config
            );
            
            var randomColorGenerator = function() {
                return '#' + (Math.random().toString(16) + '0000000').slice(2, 8);
            };
            var city_labels = {{ Js::from($cities) }};
            var city_areas = {{ Js::from($city_chart_areas) }};
            var city_chart_users = {{ Js::from($city_chart_users) }};
            var city_chart_instructors = {{ Js::from($city_chart_instructors) }};

            const cityData = {
                labels: city_labels,
                datasets: [{
                    label: 'areas',
                    data: city_areas,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                    ],
                    borderColor: [
                        'rgb(255, 99, 132)',
                    ],
                    borderWidth: 1
                }, {
                    label: 'users',
                    data: city_chart_users,
                    backgroundColor: [
                        'rgba(255, 159, 64, 0.2)',

                    ],
                    borderColor: [
                        'rgb(255, 159, 64)',
                    ],
                    borderWidth: 1
                }, {
                    label: 'instructors',
                    data: city_chart_instructors,
                    backgroundColor: [
                        'rgba(201, 203, 207, 0.2)',

                    ],
                    borderColor: [

                        'rgb(153, 102, 255)',
                    ],
                    borderWidth: 1
                }],

            };

            const cityConfig = {
                type: 'bar',
                data: cityData,
                options: {},
            };

            const cityChart = new Chart(
                document.getElementById('CityChart'),
                cityConfig
            );
        </script>
    @endpush
@endsection
