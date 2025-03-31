@extends('applicant.applicant_dashboard')
@section('applicant')
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">


                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

{{--                            <div class="col-md-4">--}}
{{--                                <div class="card card-inverse text-white">--}}
{{--                                    <img class="card-img img-fluid" src="{{asset('backend/assets/images/small/img-7.jpg')}}" alt="Card image">--}}
{{--                                    <div class="card-img-overlay">--}}
{{--                                        <h5 class="card-title text-white">Job Application Successful</h5>--}}
{{--                                        <p class="card-text">This is to notify you that your application for vacancy {{$vacancy->jobTitle}} was successful.--}}
{{--                                            <br>--}}
{{--                                            ADAK is an Equal Opportunity Employer.--}}
{{--                                        </p>--}}
{{--                                        <p class="card-text">--}}
{{--                                            <small class="" style="color: red">Only Shortlisted Candidates will be Contacted</small>--}}
{{--                                        </p>--}}
{{--                                    </div>--}}
{{--                                </div> <!-- end card-->--}}
{{--                            </div>--}}

                            <div class="row">


                                <div class="col-lg-8"  >
                                    <div class="card text-white bg-primary mb-3" >
                                        <div class="card-header bg-success">Job Application Successful</div>
                                        <div class="card-body" style="background-color: #EE4049" >
                                        <p>  Your application for the position of <b style="color:black;"> {{$vacancy}}</b> at ICTA has been successful. <br>

                                            As an Equal Opportunity Employer, ICTA is committed to promoting diversity and ensuring a fair and inclusive hiring process. We appreciate your interest in joining our organization. <br>

                                            Please note that only shortlisted candidates will be contacted for further stages of the selection process. <br>

                                            Thank you for your interest in ICTA.

                                       </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2">

                                </div>
                                <a href="{{route('applicant.dashboard')}}">Back To Dashboard</a>
                            </div>




                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->
            </div>




        </div> <!-- container -->

    </div> <!-- content -->


@endsection
