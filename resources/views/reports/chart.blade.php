@extends('admin_dashboard')
@section('admin')
    <div class="content">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <!-- Start Content-->
        <div class="container-fluid">


            <div id="container"></div>



            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    Highcharts.chart('container', {
                        chart: {
                            type: 'column'
                        },
                        title: {
                            text: 'Corn vs wheat estimated production for 2020',
                            align: 'left'
                        },
                        subtitle: {
                            text: 'Source: <a target="_blank" href="https://www.indexmundi.com/agriculture/?commodity=corn">indexmundi</a>',
                            align: 'left'
                        },
                        xAxis: {
                            categories: ['USA', 'China', 'Brazil', 'EU', 'India', 'Russia'],
                            crosshair: true,
                            accessibility: {
                                description: 'Countries'
                            }
                        },
                        yAxis: {
                            min: 0,
                            title: {
                                text: '1000 metric tons (MT)'
                            }
                        },
                        tooltip: {
                            valueSuffix: ' (1000 MT)'
                        },
                        plotOptions: {
                            column: {
                                pointPadding: 0.2,
                                borderWidth: 0
                            }
                        },
                        series: [
                            {
                                name: 'Corn',
                                data: [406292, 260000, 107000, 68300, 27500, 14500]
                            },
                            {
                                name: 'Wheat',
                                data: [51086, 136000, 5500, 141000, 107180, 77000]
                            }
                        ]
                    });
                });
            </script>


        </div> <!-- container -->

    </div> <!-- content -->

    <script>
        $(document).ready(function() {
            $.ajax({
                url: "{{ route('fetchChartData') }}", // Adjust the route according to your setup
                type: "GET",
                dataType: "json",
                success: function(data) {
                    renderChart(data);
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });
@endsection
