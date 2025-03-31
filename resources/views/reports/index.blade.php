@extends('admin_dashboard')
@section('admin')
    <div class="content">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <!-- Start Content-->
        <div class="container-fluid">

            @foreach($vacancies as $vacancy)
                <h2>Vacancy: {{ $vacancy->jobTitle }}</h2>
                <ul>
                    @foreach($counties as $county)
                        <li>
                            County: {{ $county->name }} -
                            Applications: {{ $county->job_applications_count }}
                        </li>
                    @endforeach
                </ul>
            @endforeach




        </div> <!-- container -->

    </div> <!-- content -->

    <script>
        $(document).ready(function() {
            $.ajax({
                url: '/vacancies',
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    // Process data and update UI
                }
            });
        });
    </script>

@endsection
