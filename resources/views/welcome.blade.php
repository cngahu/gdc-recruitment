@php
    $vacancies = DB::table('vacancies')
        ->join('recruitments', 'vacancies.Recruitmentid', '=', 'recruitments.id')
           ->where('vacancies.job_type', 'External')
        ->where('recruitments.closeDate', '>=', today())

        ->select('vacancies.*', 'recruitments.closeDate as closedate')
        ->get();
@endphp

    <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>GDC Recruitment System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured recruitment system for GDC" name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <script src="https://cdn.userway.org/widget.js" data-account="mz58FyckjC"></script>
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
        border: 1px solid #2D3382;
    }
    body {

        background-size: cover; /* Adjust as needed */

    }
</style>
</head>


{{--<body style="background: linear-gradient(45deg, #007A33, #FE5000, #101820); background-size: cover;">--}}
<body style="background: linear-gradient(45deg, #007A33, #A7A8AA); background-size: cover;">




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
                                    <a href="https://www.gdc.co.ke/" target="_blank">    <img src="{{asset('backend/assets/images/logo-dark.png') }}" width="100%"  alt=""></a>
                                </div>
                                <div class="col-md-5">
                                    <br>
{{--                                    <h5 style="font-weight: bolder;text-align: center">The National Council for Children’s Service (NCCS) </h5>--}}
                                    <br>

{{--                                    <h5 style="text-align: center;font-weight: bolder">ICTA Recruitment Portal</h5>--}}
                                </div>


                                <div class="col-md-3">
                                    <br>
                                    @if (Route::has('login'))
                                        <div class="sm:fixed sm:top-0 sm:right-0 p-2 text-right z-10">
                                            @auth
                                                @php
                                                    $user=\App\Models\User::where('id',\Illuminate\Support\Facades\Auth::user()->id)->first();

                                                @endphp
                                                @if($user->role=="admin")
                                                    <a href="{{ route('admin.dashboard') }}" class="btn btn-info custom-color-btn px-3 radius-30">Dashboard</a>

                                                @elseif($user->role=="applicant")
                                                    <a href="{{ route('applicant.dashboard') }}" class="btn btn-info custom-color-btn px-3 radius-30">Dashboard</a>

                                                @elseif($user->role=="panelist")
                                                    <a href="{{ route('panelist.dashboard') }}" class="btn btn-info custom-color-btn px-3 radius-30">Dashboard</a>
                                                @endif
                                                @else
                                                <a href="{{ route('login') }}" class="btn  custom-color-btn px-3 radius-50" style="background-color: #057833;color: whitesmoke">Login</a>
                                                @if (Route::has('register'))
                                                    <a href="{{ route('register') }}" class="btn  custom-color-btn px-3 radius-50" style="background-color: #057833;color: whitesmoke">Register</a>
                                                @endif
                                            @endauth
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

{{--                        <hr  class="new4">--}}
{{--                        <hr class="new4" style="background-color: #EE4049;">--}}
                        <hr class="new4" style="border: 1px solid #057833;">


                        <br>
                        <div class="text-center w-75 m-auto">
                            <div >
                                <h4 style="text-align: justify">Welcome To Geothermal Development Company (GDC) Recruitment portal</h4>
                                <br>
                                <p style="text-align: justify">
                                    Geothermal Development Company’s formation is a result of the enactment of the Energy Act No. 12 of 2006, after the adoption of Sessional Paper No. 4 on Energy in 2004 that unbundled the country’s energy sector into five sub-sectors: generation, transmission, distribution, regulation and policy.                                    <br>

                                    <ol>
                                    <li style="text-align: left">
                                        <strong>Login Credentials:</strong> <br>

                                        Log in using the email address and password you set during the registration process.


                                    </li>
                                    <li style="text-align: left">
                                       <strong>Create Your Profile:</strong><br>

                                           - Fill in your personal details.<br>

                                          	-Provide information regarding your academic qualifications, ranging from KCPE/KCSE to PhD.<br>
                                          	-Include details about your professional qualifications.<br>
                                       -	Specify any memberships you hold with professional bodies.<br>
                                           	-Document your work experience.<br>
                                          - 	Upload a statutory identification document for verification purposes.<br>

                                    </li>



                                </ol>

                                    <p style="text-align: justify">
                                    Once you have successfully completed the profile creation process, you are now ready to apply for the desired position. Feel free to apply for multiple positions if you meet the qualifications.<br>
                                        <br>

                                It is imperative to double-check and ensure that you have provided accurate and up-to-date information throughout the registration and profile creation process. Any inaccuracies may affect the evaluation of your application.<br>
                                        <br>
                                        We appreciate your interest in joining our team and look forward to reviewing your application.



                                </p>

                                <div style="text-align: justify" class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show" role="alert">
                                    Note:  GDC does NOT have recruitment agents and does NOT charge a fee at any stage of its recruitment process. Report any incident of extortion to PSASB or to the Police!  <br>

                                </div>

                                <br>

                                @if (Route::has('login'))
                                    <div class="sm:fixed sm:top-0 sm:right-0 p-2 text-right z-10">
                                        @auth
                                            @php
                                                $user=\App\Models\User::where('id',\Illuminate\Support\Facades\Auth::user()->id)->first();

                                            @endphp
                                            @if($user->role=="admin")
                                                <a href="{{ route('admin.dashboard') }}" class="btn  custom-color-btn px-3 radius-30" style="background-color: #EE4049;color: whitesmoke">Job Openings</a>

                                            @elseif($user->role=="applicant")
                                                <a href="{{ route('applicant.dashboard') }}" class="btn  custom-color-btn px-3 radius-30" style="background-color: #EE4049;color: whitesmoke"> Job Openings</a>

                                            @elseif($user->role=="panelist")
                                                <a href="{{ route('panelist.dashboard') }}" class="btn  custom-color-btn px-3 radius-30"  style="background-color: #EE4049;color: whitesmoke">Job Openings</a>
                                            @endif
                                        @else
                                            <p>
                                                <a href="{{ url('login') }}" class="btn  btn-lg custom-color-btn"  style="background-color: #D52E2F;color: whitesmoke">Job Openings &gt; »</a>

                                            </p>

                                        @endauth
                                    </div>
                                @endif

                            </div>
                        </div>
                        <br>
                        <br>
                        @if(count($vacancies)>0)
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">


                                        <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
                                            <thead>
                                            <tr>
                                                <th>SN:</th>
                                                <th>Job Title :</th>
                                                <th>Terms Of Service :</th>
                                                <th>Min Salary :</th>
                                                <th>Max Salary :</th>
                                                <th>No Sought :</th>
                                                <th>Ref :</th>
                                                <th>Details :</th>
                                                {{--                                    <th>Close Date</th>--}}
                                                <th>Actions :</th>

                                            </tr>
                                            </thead>


                                            <tbody>
                                            @foreach($vacancies as $key=> $item)
                                                <tr>
                                                    <td>{{ $key+1 }}</td>
                                                    <td style="text-transform: uppercase">{{ $item->jobTitle }}</td>
                                                    <td style="text-transform: uppercase">{{ $item->jobtype }}</td>
                                                    <td style="text-transform: uppercase">{{ $item->min_salary }}</td>
                                                    <td style="text-transform: uppercase">{{ $item->max_salary }}</td>
                                                    <td>{{ $item->Positions }}</td>
                                                    <td style="text-transform: uppercase">{{ $item->VacancyReference }}</td>
                                                    <td>
                                                        <a href="{{route('vacancy.details',$item->id)}}" class="btn " style="background-color: #EE4049;color: whitesmoke">Details</a>

                                                    </td>

                                                    <td>
                                                        <a href="{{route('login')}}" class="btn btn-danger">Apply</a>
                                                    </td>



                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>

                                    </div> <!-- end card body-->
                                </div> <!-- end card -->
                            </div><!-- end col-->
                        </div>
                        @else
                            <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                                <thead>
                                <tr>
                                    <th>SN :</th>
                                    <th>Job Title :</th>
                                    <th>Grade :</th>
                                    <th>No Sought :</th>
                                    <th>Ref :</th>
                                    <th>Details :</th>
                                    {{--                                    <th>Close Date</th>--}}
                                    <th>Actions :</th>

                                </tr>
                                </thead>


                                <tbody>
                               <tr>
                                   <td colspan="7">
                                       <div class="alert alert-danger" role="alert" style="margin-top:10px;">
                                           <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                           <span class="sr-only">Error:</span>
                                           <b> Note:</b>

                                        There are currently no available job positions.
                                       </div>
                                   </td>
                               </tr>
                                </tbody>
                            </table>


                        @endif
                        <div class="alert alert-info">
                            <h4> Only successful candidates will be required to submit clearance certificates from the following bodies:</h4>
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
                        <p style="text-align: center; font-style: italic">GDC commits to handling your data in accordance with the Data Protection Act, 2019 and any other relevant legislation</p>


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
   &copy;  <a href="https://www.gdc.co.ke/" class="text-black-50" target="_blank" style="font-weight: bolder">GDC</a>   <script>document.write(new Date().getFullYear())</script>
</footer>

<!-- Vendor js -->
<script src="{{asset('backend/assets/js/vendor.min.js')}}"></script>

<!-- App js -->
<script src="{{asset('backend/assets/js/app.min.js')}}"></script>

</body>
</html>


