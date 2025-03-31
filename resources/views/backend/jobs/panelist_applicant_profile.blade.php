@extends('panelist.panelist_dashboard')
@section('panelist')
    <!-- CSS -->
    {{--    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" >--}}

    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Profile For:</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page"></li>
                        <h3>
                            Applicant Profile - <span style="color:indianred; font-size:10pt;">

        <a style="text-decoration:none; color:indianred; font-size:20pt;" href="#">
           {{$userid->first_name}} {{$userid->other_name}} {{$userid->last_name}}
        </a>

    </span>
                            <a href="{{route('panelist.applicants',$vacancy->id)}}" class="btn btn-danger">Back To Profiles</a>


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
                            <th>Ethnicity</th>
                            <th>Gender</th>
                            <th>Disability</th>
                            <th>DOB</th>

                        </tr>



                            <tr class=".table-striped">

                                <td> {{$userid->first_name}} {{$userid->other_name}} {{$userid->last_name}}</td>
                                <td> {{$userid->idnumber}}</td>
                                <td> {{$userid['ccounty']['name']}}</td>
                                <td> {{$userid['ethnicity1']['name']}}</td>
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
                            <td>{!! $item->Duties !!}}</td>
                            <td>{{$item->startDate}}</td>
                            <td>{{$item->exitReasons}}</td>




                        </tr>
                    @endforeach


                </table>
            </div>
            <div>
                <section class="attachments">
                    <h3 style="background-color: darkgreen; color: white; text-align: center" >Attachments</h3>

                    <table  class="table dt-responsive nowrap w-100">
                        <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Document Name</th>
                            <th>Link</th>
                            {{--                                <th>Action</th>--}}
                        </tr>
                        </thead>


                        <tbody>
                        @foreach($jobdocs as $key=> $item)
                            <tr>
                                <td>{{ $key+1 }}</td>

                                <td>{{ $item['document']['document_name']}}</td>
                                <td>
                                    <a href="  {{asset($item->path)}}" target="_blank">Link</a>

                                </td>

                                {{--                                    <td>--}}
                                {{--                                        <a href="{{ route('applicantdoc.edit',$item->id) }}" class="btn btn-blue rounded-pill waves-effect waves-light">Edit</a>--}}
                                {{--                                        <a href="{{ route('applicantdoc.delete',$item->id) }}" class="btn btn-danger rounded-pill waves-effect waves-light" id="delete">Delete</a>--}}
                                {{--                                    </td>--}}
                            </tr>
                        @endforeach
                        </tbody>
                    </table>



                </section>
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

                                <a href="{{asset($docitem->path)}}" target="_blank">{{$docitem['document']['document_name']}}  </a>
                                &nbsp;|&nbsp;
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
        <a href="{{route('panelist.applicants',$vacancy->id)}}" class="btn btn-danger">Back To Profiles</a>


    </div>

@endsection


{{--href="{{ asset($agentData->cert_of_incorporation) }}"--}}
