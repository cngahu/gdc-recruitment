@extends('applicant.applicant_dashboard')
@section('applicant')
    <!-- CSS -->
    {{--    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" >--}}

    <div class="page-content">
        <!--breadcrumb-->

        <div >
            <h2 style="color:indianred; font-size:15pt;">This is how your profile for this vacancy is. Should you wish to make corrections, kindly edit accordingly on the sections highlighted on the left </h2>

        </div>
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">

            <div class="breadcrumb-title pe-3">Profile For:</div>

            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page"></li>

                        <h3>
                            Applicant Profile - <span >

        <a style="text-decoration:none; color:indianred; font-size:20pt;" href="#">
           {{$userid->first_name}} {{$userid->other_name}} {{$userid->last_name}}
        </a>


    </span>


                        </h3>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">

            </div>
        </div>
        <!--end breadcrumb-->

        <hr/>
        <div class="card">
            <div class="card-body">
                <div style="background-color:#073763; color:#FFFFFF; border-bottom:solid;border-width:3px;border-bottom-color:#DE8500;text-align:center;">
                   Profile
                </div>
                <div>
                    <table class="table table-condensed">
                        <tr>
                            <th>Name</th>
                            <th>ID Number</th>
                            <th>County</th>
                            <th>Gender</th>
                            <th>Disability</th>
                            <th>DOB</th>

                        </tr>



                            <tr class=".table-striped">

                                <td> {{$userid->first_name}} {{$userid->other_name}} {{$userid->last_name}}</td>
                                <td> {{$userid->idnumber}}</td>
                                <td> {{$userid['ccounty']['name']}}</td>
                                <td> {{$userid['cgender']['name']}}</td>
                                <td> {{$userid->disability}}</td>
                                <td>{{$userid->dob}}</td>


                            </tr>




                    </table>
                </div>
            </div>
            <div style="background-color:#555555; color:#FFFFFF; border-bottom:solid;border-width:3px;border-bottom-color:#DE8500;text-align:center;">
                Educational Qualifications
            </div>
            <div>
                <table class="table table-condensed">
                    <tr>
                        <th>No</th>
                        <th>Institution</th>
                        <th>Level</th>
                        <th>Course</th>
                        <th>Exit Date</th>
                        <th>Grade</th>
                       <th>Category</th>
                        <th>Certificate</th>

                    </tr>

                    @foreach ($educationquals as $key =>$item)

                        <tr class=".table-striped">
                            <td> {{ $key+1 }} </td>
                            <td>{{$item->institutionName}}</td>
                            <td>{{$item['assign_academiclevel']['name']}}</td>
                            <td>{{$item->courseName}}</td>
                            <td>{{$item->exitDate}}</td>
                            <td>{{$item['assign_grade']['name']}}</td>
                            <td>{{$item['assign_category']['name']}}</td>
                            <td><a href="{{asset($item->certificate)}}" target="_blank" >View Certificate</a> </td>




                        </tr>
                    @endforeach



                </table>
            </div>
            <div>
                <table class="table table-condensed ">
                    <tr>
                        <th colspan="7" style="background-color:#8F3B29;text-align:center;color:white">
                            Professional Qualifications
                        </th>
                    </tr>
                    <tr>

                        <th>No</th>
                        <th>Institution</th>
                        <th>Course</th>

                        <th>Completion Date</th>
                        <th>Grade</th>
                        <th>Certificate</th>



                    </tr>

                    @foreach($proffessionalquals as $key=> $item)
                        <tr class=".table-striped">
                            <td> {{ $key+1 }} </td>
                            <td>{{$item->institutionName}}</td>
                            <td>{{$item->courseName}}</td>

                            <td>{{$item->exitDate}}</td>
                            <td>{{$item->grade}}</td>
                            <td><a href="{{asset($item->certificate)}}" target="_blank" >View Certificate</a> </td>




                        </tr>
                    @endforeach

                </table>
            </div>
            <div>
                <table class="table table-condensed">
                    <tr>
                        <th colspan="7" style="background-color:#117A65;text-align:center;color:white">
                            Professional Membership Bodies
                        </th>
                    </tr>
                    <tr>
                        <th>No</th>
                        <th>Professional Body</th>
                        <th>Membership Number</th>
                        <th>Certificate</th>

                    </tr>

                    @foreach($memberships as $key=> $item)
                        <tr class=".table-striped">
                            <td> {{ $key+1 }} </td>
                            <td>{{$item->proffBody}}</td>
                            <td>{{$item->memberNumber}}</td>

                            <td><a href="{{asset($item->memberCertificate)}}" target="_blank" > View Certificate</a> </td>




                        </tr>
                    @endforeach

                </table>
            </div>
            <div>
                <table class="table table-condensed">
                    <tr>
                        <th colspan="7" style="background-color:#138496;text-align:center;color:white">
                            Work History
                        </th>
                    </tr>
                    <tr>
                        <th>No</th>
                        <th>Company</th>
                        <th>Job Title</th>
                        <th>Duties</th>
                        <th>Start Date</th>
                        <th>Exit Reasons</th>


                    </tr>
                    @foreach($workexperience as $key=> $item)
                        <tr class=".table-striped">
                            <td> {{ $key+1 }} </td>
                            <td>{{$item->company}}</td>
                            <td>{{$item->jobTitle}}</td>
                            <td>{!! $item->Duties !!}</td>
                            <td>{{$item->startDate}}</td>
                            <td>{{$item->exitReasons}}</td>




                        </tr>
                    @endforeach


                </table>
            </div>

            <div>
                <table class="table table-condensed">
                    <tr>
                        <th colspan="7" style="background-color:black;text-align:center;color:white">
                            Jobs Applied
                        </th>
                    </tr>
                    <tr>
                        <th>SN</th>
                        <th>
                            Vacancy
                        </th>
                        <th>

                        </th>
                    </tr>
                    <tr>
                        <td>
                            {{$vacancy->jobTitle}}
                        </td>
                        <td>
                            @foreach($uploaddocs as $key=>$docitem)

{{--                                <a href="{{asset($docitem->path)}}" target="_blank" >Click Here To view the {{$docitem['document']['document_name']}} uploaded </a>||<a href="{{route('pv.edit.jobapplied',$applicationid)}}" style="color: red">Change This</a>--}}
                                <a href="{{asset($docitem->path)}}" target="_blank" >Click Here To view the {{$docitem['document']['document_name']}} uploaded </a>||<a href="{{route('pedit',$applicationid)}}" style="color: red"> {{$applicationid}}Change This</a>

                                <br>
                            @endforeach
                        </td>


                    </tr>

{{--                    @foreach ($applications as $key =>$item)--}}
{{--                        <tr>--}}
{{--                            <td>{{$key +1}}</td>--}}
{{--                            <td>{{$item['assign_vacancy']['JobTitle']}}</td>--}}
{{--                            <td>--}}
{{--                                @php--}}
{{--                                $coverletter='D-6-'.$item->VacancyID.'-'.$id.'.pdf';--}}
{{--                                $resume='D-5-'.$item->VacancyID.'-'.$id.'.pdf';--}}
{{--                                $psc='D-8-'.$item->VacancyID.'-'.$id.'.pdf';--}}
{{--                                    $idd='D-1'.$id.'.pdf';--}}

{{--                                @endphp--}}
{{--                                <a  href="{{asset('uploads/JobSpecifcDocs/'.$resume)}}" target="_blank" style="text-decoration:none; color:indianred; font-size:10pt;">View Resume</a>--}}
{{--                                <a href="{{asset('uploads/JobSpecifcDocs/'.$coverletter)}}" target="_blank" style="text-decoration:none; color:green; font-size:10pt; ">View Cover Letter</a>--}}
{{--                                <a href="{{asset('uploads/JobSpecifcDocs/'.$psc)}}" target="_blank" style="text-decoration:none; color:blue; font-size:10pt; ">View PSC</a>--}}
{{--                                <a href="{{asset('uploads/CommonDocs/'.$idd)}}" target="_blank" style="text-decoration:none; color:darkmagenta; font-size:10pt; ">View ID</a>--}}

{{--                            </td>--}}


{{--                        </tr>--}}
{{--                    @endforeach--}}

                </table>
            </div>

        </div>
{{--        <a href="{{route('job.applicants',$vacancy->id)}}" class="btn btn-danger">Back To Profiles</a>--}}
{{--        <a href="{{route('jobsapply.success',$vacancy->id)}}" class="btn btn-danger">Submit Application</a>--}}
{{--        <a href="{{route('jobsapply.success',$vacancy->id)}}" class="btn btn-danger">Submit Application</a>--}}

                <a href="{{route('applicant.dashboard')}}" class="btn btn-danger">Back To Dashboard</a>

        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#success-alert-modal">Submit Application</button>
    </div>

    <div id="standard-modal" class="modal fade" tabindex="-1" aria-labelledby="standard-modalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="standard-modalLabel">Are You Sure?</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h6>Are You Sure Ypu want to submit thus?</h6>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <a href="{{route('jobsapply.success',$vacancy->id)}}" class="btn btn-danger">Submit Application</a>

                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    <div id="success-alert-modal" class="modal fade" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content modal-filled bg-success">
                <div class="modal-body p-4">
                    <div class="text-center">
                        <i class="dripicons-checkmark h1 text-white"></i>
                        <h4 class="mt-2 text-white">Well Done!</h4>
                        <p class="mt-3 text-white">Are You Sure You Want To Submit This Application?</p>
                        <a href="{{route('jobsapply.success',$vacancy->id)}}" class="btn btn-danger">Submit Application</a>

                        <button type="button" class="btn btn-light my-2" data-bs-dismiss="modal">No</button>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
@endsection



{{--href="{{ asset($agentData->cert_of_incorporation) }}"--}}
