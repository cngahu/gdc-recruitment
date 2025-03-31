@extends('panelist.panelist_dashboard')
@section('panelist')
    <!-- CSS -->
    {{--    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" >--}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

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
                            {{$myvacancy->jobTitle}}
                        </td>
                        <td>
                            @foreach($uploaddocs as $key=>$docitem)

                                <a href="{{asset($docitem->path)}}" target="_blank">{{$docitem['document']['document_name']}}  </a>
                                &nbsp;|&nbsp;
                            @endforeach
                        </td>


                    </tr>



                </table>
            </div>


            <div class="form-control">
                <h2 style="color: red">Shortlisting Decision</h2>
                <form id="myForm" method="post" action="{{route('shortlist.post')}}"  >
                    @csrf

                    <input type="hidden" name="applicationid" value="{{$specificapplication->id}}">
                    <input type="hidden" name="vacancyid" value="{{$myvacancy->id}}">
                    <input type="hidden" name="stageid" value="{{$stageid->id}}">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="inputLastName2" class="form-label" style="font-size:large">Committee Decision</label>
                            <div class="form-group">
                                <select name="decision"  id="decision" required="" class="form-control">
                                    <option value="" selected="" >Select Decision</option>
                                    <option value="1"  >Shortlist</option>
                                    <option value="2"  >Reject</option>
                                    <option value="3"  >Pending</option>
                                </select>
                                <x-input-error :messages="$errors->get('decision')" style="color: red" class="mt-2" />

                            </div>
                        </div>
                        <br>
                        <div class="col-md-6" style="display:none" id="hidediv">
                            <label for="inputLastName2" class="form-label"style="font-size:large">Review Comments</label>
                            <div class="form-group">
                                <textarea name="comments" class="form-control" type="text"></textarea>
                                <x-input-error :messages="$errors->get('comments')" style="color: red" class="mt-2" />

                            </div>
                        </div>


                    </div>

<p></p>
                    <div class="col-m-6 form-control" id="buttonsdiv">
                        <input type="submit" class="btn btn-primary " value="Save Changes" />
                    </div>

                </form>

            </div>

        </div>


    </div>
    <script type="text/javascript">
        $(function () {

            $('#decision').on('change', function() {


                    if ($('#decision').val()=='3'||$('#decision').val()=='2')
                {
                    $("#hidediv").show();



                }
                else
                {

                    $("#hidediv").hide();
                    $("#comments").val('');


                }



            });
        });

        $(document).ready(function (){
            $('#myForm').validate({
                rules: {

                    decision: {
                        required : true,
                    },
                    comments: {
                        required : function(element){
                            return Number($('#decision').val()=='No');
                        },
                    },

                },
                messages :{
                    comments: {
                        required : 'Required',
                    },
                    decision: {
                        required : 'Required',
                    },

                },
                errorElement : 'span',
                errorPlacement: function (error,element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight : function(element, errorClass, validClass){
                    $(element).addClass('is-invalid');
                },
                unhighlight : function(element, errorClass, validClass){
                    $(element).removeClass('is-invalid');
                },
            });
        });



    </script>
{{--    <script type="text/javascript">--}}
{{--        $(document).ready(function () {--}}
{{--            $('#myForm').submit(function () {--}}

{{--                $("#buttonsdiv").html('<div class="spinner-border" role="status"> <span class="visually-hidden">Loading...</span></div>');--}}

{{--                return true;--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}
@endsection


{{--href="{{ asset($agentData->cert_of_incorporation) }}"--}}
