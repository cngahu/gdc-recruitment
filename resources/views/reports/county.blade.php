@extends('admin_dashboard')
@section('admin')
    <div class="content">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://code.highcharts.com/modules/exporting.js" style=""></script>
        <script src="https://code.highcharts.com/modules/export-data.js" style=""></script>
        <script src="https://code.highcharts.com/modules/accessibility.js" style=""></script>
        <!-- Start Content-->
        <div class="container-fluid">


            <div id="container"></div>
            <div class="highcharts-a11y-proxy-group highcharts-a11y-proxy-group-chartMenu"><button class="highcharts-a11y-proxy-element highcharts-no-tooltip" aria-label="View chart menu, World's largest cities per 2021" aria-expanded="false" title="Chart context menu" style="border-width: 0px; background-color: transparent; cursor: pointer; outline: none; opacity: 0.001; z-index: 999; overflow: hidden; padding: 0px; margin: 0px; display: block; position: absolute; width: 28px; height: 28px; left: 707px; top: 11px;"></button></div>

            <script>
                Highcharts.chart('container', {
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: 'Vacancy Application Distribution By County - <?php echo htmlspecialchars($vacancy->jobTitle, ENT_QUOTES); ?>'
                    },
                    subtitle: {
                        text: 'Source: <a target="_blank" href="https://recruitment.knchr.org/">KNCHR Recruitment Portal</a>',

                    },
                    xAxis: {
                        type: 'category',
                        labels: {
                            autoRotation: [-45, -90],
                            style: {
                                fontSize: '13px',
                                fontFamily: 'Verdana, sans-serif'
                            }
                        }
                    },
                    yAxis: {
                        min: 0,
                        title: {
                            text: 'Population (millions)'
                        }
                    },
                    legend: {
                        enabled: false
                    },
                    tooltip: {
                        pointFormat: 'Total: <b>{point.y} Applicants</b>'
                    },
                    series: [{
                        name: 'Population',
                        colors: [
                            '#9b20d9', '#9215ac', '#861ec9', '#7a17e6', '#7010f9', '#691af3',
                            '#6225ed', '#5b30e7', '#533be1', '#4c46db', '#4551d5', '#3e5ccf',
                            '#3667c9', '#2f72c3', '#277dbd', '#1f88b7', '#1693b1', '#0a9eaa',
                            '#03c69b',  '#00f194'
                        ],
                        colorByPoint: true,
                        groupPadding: 0,
                        data: [
                                @foreach($applicantsByCounty as $county)
                            ['{{ $county->county_name }}', {{ $county->total_applicants }}],
                            @endforeach
                        ],
                        dataLabels: {
                            enabled: true,
                            rotation: -90,
                            color: '#FFFFFF',
                            inside: true,
                            verticalAlign: 'top',
                            format: '{point.y:.1f}', // one decimal
                            y: 10, // 10 pixels down from the top
                            style: {
                                fontSize: '13px',
                                fontFamily: 'Verdana, sans-serif'
                            }
                        }
                    }]
                });
            </script>





        </div> <!-- container -->

    </div> <!-- content -->

    <script>

@endsection
