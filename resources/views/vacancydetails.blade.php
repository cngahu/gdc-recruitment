
    <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Vacancy Details Page | PSASB</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured recruitment system for Public Sector Accounting Standards Board (PSASB)" name="description" />
    <meta content="Canjetan Ngahu" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('backend/assets/images/favicon.ico')}}">
    <!-- Bootstrap css -->
    <link href="{{asset('backend/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- App css -->
    <link href="{{asset('backend/assets/css/app.min.css')}}" rel="stylesheet" type="text/css" id="app-style"/>
    <!-- icons -->
    <link href="{{asset('backend/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Head js -->
    <script src="{{asset('backend/assets/js/head.js')}}"></script>
<style>
    /* Thick red border */
    hr.new4 {
        border: 1px solid #4FC6E1;
    }
</style>
</head>

{{--<body style="background-image: url('{{ asset('backend/assets/images/background.png') }}');background-size: cover;">--}}
<body style="background-color: #2D3382;background-size: cover;">

<div class="account-pages mt-5 mb-5">
    <div class="container">
        <div class="row justify-content-center">
{{--            class="col-md-10 col-lg-12 col-xl-8"--}}
            <div>
                <div class="card bg-pattern">



                    <div class="card-body p-4">

                        <div class="header">
                            <div class="row">
                                <div class="col-md-3">
                                    <a href="https://psasb.go.ke/" target="_blank">    <img src="{{asset('backend/assets/images/logo-dark.png') }}" width="100%" alt=""></a>
                                </div>
                                <div class="col-md-5">
                                    <br>
                                    <h2 style="color:#EE4049 ">Recruitment Portal</h2>
                                </div>


                            </div>
                        </div>

                        <hr class="new4">
                        <br>
                        <div class="text-center w-75 m-auto">
                            <div >
                                <h3> PSASB Recruitment Portal</h3>
                                <br>
                                <p>
                                    Before applying for a job, please ensure that you have filled out your educational qualifications,
                                    professional qualifications, work history and experience, as well as your membership in professional bodies.
                                </p>
                                <br>


                            </div>
                        </div>
                        <br>
                        <br>
                        <div class="panel panel-danger">

                            <div class="panel-body">
                                <table id="w0" class="table table-striped table-bordered detail-view"><tbody>
                                    <tr><th>Job Title</th><td>{{$vacancydetails->jobTitle}}</td></tr>
                                    <tr><th>Job Type</th><td>{{$vacancydetails->jobtype}}</td></tr>
                                    <tr><th>Job Min Salary</th><td>{{$vacancydetails->min_salary}}</td></tr>
                                    <tr><th>Job Max Salary</th><td>{{$vacancydetails->max_salary}}</td></tr>
                                    <tr><th>Job Description</th><td>{!! $vacancydetails->jobDescription !!}</td></tr>
                                    <tr><th>Job Specification</th><td>{!! $vacancydetails->jobSpecification !!}</td></tr>
                                    <tr><th>Grade</th><td>{{$vacancydetails->positionCode}}</td></tr>
                                    <tr><th>No Sought</th><td>{{$vacancydetails->Positions}}</td></tr>

                                    <tr><th>Advert Ref </th><td>{{$vacancydetails->VacancyReference}}</td></tr>
                                    <tr>
                                        <th>Job Upload Attachments</th>
                                        <td>
                                            @if($docs->isNotEmpty())
                                                <ul>
                                                    @foreach($docs as $doc)
                                                        <li>
                                                            {{ $doc->document->document_name }}
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @else
                                                <p>No uploads available.</p>
                                            @endif
                                        </td>
                                    </tr>

                                    </tbody></table>

                            </div>
                            <div class="panel-footer">



                                <a href="/" style="float:right;">
{{--        --}}
                                </a>

<a href="/" class="btn btn-info">Home</a>
                            </div>

                        </div>
                        <div class="alert alert-info">
                            <h6>Successful candidates will be required to submit clearance certificates from the following bodies:</h6>
                            <div class="text-dark">
                                <ul>
                                    <li>Kenya Revenue Authority - (Valid Tax compliance certificate).</li>
                                    <li>Directorate of Criminal Investigations - (Certificate of good conduct)</li>
                                    <li>Higher Education Loans Board - (Compliance certificate, where applicable)</li>
                                    <li>Ethics and Anti – Corruption Commission - (Self-Declaration form)</li>
                                    <li>Credit Reference Bureau - (Certificate of clearance or credit report)</li>
                                </ul>
                            </div>
                        </div>


                    </div> <!-- end card-body -->
                </div>
                <!-- end card -->

                <div class="row mt-3">
                    <div class="col-12 text-center">
                    </div> <!-- end col -->
                </div>
                <!-- end row -->

            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</div>
<!-- end page -->


<footer class="footer footer-alt">
     <script>document.write(new Date().getFullYear())</script> &copy;  <a href="https://psasb.go.ke/" class="text-white-50" target="_blank">PSASB</a>
</footer>

<!-- Vendor js -->
<script src="{{asset('backend/assets/js/vendor.min.js')}}"></script>

<!-- App js -->
<script src="{{asset('backend/assets/js/app.min.js')}}"></script>

</body>
</html>


