@extends('admin_dashboard')
@section('admin')
    <div class="content">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <!-- Start Content-->
        <div class="container-fluid">



            <div id="container"></div>

        <div id="highchart">


        </div>





            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    Highcharts.chart('container', {
                        chart: {
                            type: 'column'
                        },
                        title: {
                            text: 'Summary of Vacancy Applications By Gender',
                            align: 'left'
                        },
                        subtitle: {
                            // text: 'Source: <a target="_blank" href="https://www.indexmundi.com/agriculture/?commodity=corn">indexmundi</a>',
                            text: 'Source: <a target="_blank" href="https://recruitment.knchr.org/">KNCHR Recruitment Portal</a>',

                            align: 'left'
                        },
                        xAxis: {
                            // categories: ['USA', 'China', 'Brazil', 'EU', 'India', 'Russia'],
                            categories: @json($vacanciesdisp),
                            crosshair: true,
                            accessibility: {
                                description: 'Job Titles'
                            }
                        },
                        yAxis: {
                            min: 0,
                            title: {
                                text: 'Number of Applications'
                            }
                        },
                        tooltip: {
                            valueSuffix: ' (Applicants)'
                        },
                        plotOptions: {
                            column: {
                                pointPadding: 0.2,
                                borderWidth: 0
                            }
                        },
                        // series: [
                        //     {
                        //         name: 'Male',
                        //         data: [406292, 260000, 107000, 68300, 27500, 14500]
                        //     },
                        //     {
                        //         name: 'Female',
                        //         data: [51086, 136000, 5500, 141000, 107180, 77000]
                        //     },
                        //     {
                        //         name: 'Intersex',
                        //         data: [67086, 678000, 4500, 567000, 456180, 90000]
                        //     }
                        // ]
                        series: @json($seriesData)

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
