@extends('applicant.applicant_dashboard')
@section('applicant')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <div class="row">
        <h5 style="color:seagreen">Step 3 of 7</h5>

        <div class="col-lg-8 col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> Add Professional Qualification</h5>
{{--                    <div class="alert alert-info bg-info text-white border-0" role="alert">--}}
{{--                        Eg <strong>for KASNEB CPA (III). </strong>Examining body-KASNEB, Course name-CPA (III) etc!--}}
{{--                    </div>--}}
                    <div class="alert alert-danger text-center" role="alert">
                        <p>Dear Applicant, please use this page to enter your Professional Qualifications.</p>
                        <p>
                            This include e.g KASNEB CPA (III). </strong>Examining body-KASNEB, Course name-CPA (III).
                            Kindly note Leadership Courses will be added in a later stage
                        </p>
                        <p>
                            After adding a qualification, repeat the process until all qualifications have been entered, then proceed to the next stage. Fields marked with a <span style="color: red;">*</span> are mandatory.
                        </p>
                    </div>
                    <div class="row">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="customCheck1"  >
                            <label class="form-check-label" style="color: red" for="customCheck1">Click Here If You Have No Professional Qualifications</label>
                        </div>

                    </div>
                    <br>


                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <!-- end timeline content-->

                    <div class="tab-pane" id="proffqualsdiv">
                        <form method="post" id="myForm" action="{{ route('proffessionalqual.store') }}" enctype="multipart/form-data">                                    @csrf
                            @csrf

{{--                            @php--}}


{{--                                $url_confirm=url("/classification/licence/confirm/");--}}

{{--                            @endphp--}}
{{--                            <input type="hidden" name="id" id="url_path_confirm" value="{{$url_confirm}}">--}}


                            <div class="row">


                                <div class="col-md-6">
                                    <div class="mb-3 form-group">
                                        <label for="firstname" class="form-label">Institution/Examining Body <span style="color: red;">*</span></label>
                                        <input type="text" name="institutionName" id="institutionName" class="form-control @error('institutionName') is-invalid @enderror"   >
                                        @error('institutionName')
                                        <span class="text-danger"> {{ $message }} </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3 form-group">
                                        <label for="firstname" class="form-label">Course/Exam Name   <span style="color: red;">*</span></label>
                                        <input type="text" name="courseName" id="courseName" class="form-control @error('courseName') is-invalid @enderror" placeholder="Course Name"  >

                                    </div>
                                </div>






                                <div class="col-md-6">
                                    <div class="mb-3 form-group">
                                        <label for="firstname" class="form-label">Completion Date <span style="color: red;">*</span>  </label>
                                        <input  type="date" id="date_picker" name="exitDate" value="" class="form-control"  placeholder="Exit Date" />

                                    </div>
                                </div>





                                <div class="col-md-6">
                                    <div class="mb-3 form-group">
                                        <label for="grade" class="form-label">Qualification Attained  <span style="color: red;">*</span></label>
                                        <input type="text" name="grade" id="grade" class="form-control @error('courseName') is-invalid @enderror" placeholder="Qualification Attained"  >


                                    </div>
                                </div>





                                <div class="col-md-6">
                                    <div class="mb-3 form-group">
                                        <label for="certificate" class="form-label">Upload Certificate in PDF Format.Ensure document is less than 1mb <span style="color: red;">*</span></label>
                                        <input type="file" name="certificate" id="certificate" class="form-control"  accept="application/pdf">
                                    </div>
                                </div> <!-- end col -->




                            </div> <!-- end row -->


                        @if(count($proff_qual)==0)


                            <div class="text-end" id="buttonsdiv">
                                <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i class="mdi mdi-content-save"></i> Save</button>
                            </div>
                            @else
                                <div class="text-end">

                                    <a href="{{route('applicant.alleducation')}}" class="btn btn-primary">Previous</a>
                                    <button type="submit"  id="buttonsdiv" class="btn btn-success "> Save And Add Another</button>
                                    <a href="{{route('applicant.proffmembership')}}" class="btn btn-warning">Proceed To Next Stage</a>

                                </div>

                            @endif
                        </form>
                    </div>
                    <div class="" id="proceed">
                        <form method="post" action="{{route('proffessionalqual.noquals')}}">
                            @csrf
                            <input type="hidden" name="userid" value="{{$userid}}">
                            <button type="submit"  class="btn btn-success "> Proceed To Next Stage</button>
                        </form>

                    </div>
                    <!-- end settings content-->


                </div>
            </div> <!-- end card-->

        </div> <!-- end col -->
    </div>


   @if((($ccount>0)&&($user->no_certifications==1)))
    <div class="row">
        <div class="col-12">
            <!-- Portlet card -->
            <div class="card">
                <div class="card-body">
                    <div class="card-widgets">
                        <a href="javascript: void(0);" data-toggle="reload"><i class="mdi mdi-refresh"></i></a>
                        <a data-bs-toggle="collapse" href="#cardCollpase4" role="button" aria-expanded="false" aria-controls="cardCollpase4"><i class="mdi mdi-minus"></i></a>
                    </div>
                    <h4 class="header-title mb-0">My Professional Qualifications</h4>

                    <div id="cardCollpase4" class="collapse show">
                        <div class="table-responsive pt-3">
                            <table class="table table-centered table-nowrap table-borderless mb-0">
                                <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Institution</th>
                                    <th>Course</th>

                                    <th>Completion Date</th>
                                    <th>Grade</th>
                                    <th>Certificate</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($proff_qual as $key=> $item)
                                <tr class=".table-striped">
                                    <td> {{ $key+1 }} </td>
                                    <td>{{$item->institutionName}}</td>
                                    <td>{{$item->courseName}}</td>

                                    <td>{{$item->exitDate}}</td>
                                    <td>{{$item->grade}}</td>
                                    <td><a href="{{asset($item->certificate)}}" target="_blank" >Certificate</a> </td>

                                    <td>
                                        <a href="{{route('proffessionalqual.edit',$item->id)}}" class="btn btn-primary"><i class="material-symbols-outlined">edit</i></a>
                                        <a href="{{route('proffessionalqual.delete',$item->id)}}" class="btn btn-danger"  id="delete" ><i class="material-symbols-outlined">delete</i></a>

                                    </td>


                                </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div> <!-- .table-responsive -->
                    </div> <!-- end collapse-->
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->
    </div>
   @elseif(($ccount==0)&&($user->no_certifications==0)&&($user->level >= 4))
       <div class="col-12">
           <!-- Portlet card -->
           <div class="card">
               <div class="card-body">
                   <div class="card-widgets">
                       <a href="javascript: void(0);" data-toggle="reload"><i class="mdi mdi-refresh"></i></a>
                       <a data-bs-toggle="collapse" href="#cardCollpase4" role="button" aria-expanded="false" aria-controls="cardCollpase4"><i class="mdi mdi-minus"></i></a>
                   </div>
                   <h4 class="header-title mb-0">My Professional Qualifications</h4>
                   <br>
                   <div class="alert alert-warning bg-warning text-white border-0" role="alert">
                       <strong>You Do Not Have Any Professional Qualifications ! </strong>
                   </div>
                   <div>
                       <a href="{{route('applicant.alleducation')}}" class="btn btn-primary">Previous</a>

                       <a href="{{route('applicant.proffmembership')}}" class="btn btn-success">Proceed To Next Stage</a>

                   </div>
               </div> <!-- end card-body-->
           </div> <!-- end card-->
       </div> <!-- end col-->
   @else
       <div class="col-12">
           <!-- Portlet card -->
           <div class="card">
               <div class="card-body">
                   <div class="card-widgets">
                       <a href="javascript: void(0);" data-toggle="reload"><i class="mdi mdi-refresh"></i></a>
                       <a data-bs-toggle="collapse" href="#cardCollpase4" role="button" aria-expanded="false" aria-controls="cardCollpase4"><i class="mdi mdi-minus"></i></a>
                   </div>
                   <h4 class="header-title mb-0">My Professional Qualifications</h4>
                        <br>
                   <div class="alert alert-warning bg-warning text-white border-0" role="alert">
                       <strong>You Do Not Have Any Professional Qualifications ! </strong>
                   </div>

               </div> <!-- end card-body-->
           </div> <!-- end card-->
       </div> <!-- end col-->
   @endif


<script>
    $('#customCheck1').change(function() {
        if(this.checked) {
            $("#proffqualsdiv").hide();
            $("#proceed").show();

        }
        else
        {
            $("#proffqualsdiv").show();
            $("#proceed").hide();
        }
        // $('#textbox1').val(this.checked);
    });
</script>

    <script type="text/javascript">
        $(document).ready(function (){
            $("#proceed").hide();
            $('#myForm').validate({
                rules: {
                    institutionName: {
                        required : true,
                    },

                    startDate: {
                        required : true,
                    },
                    exitDate: {
                        required : true,
                    },
                    courseName: {
                        required : true,
                    },
                    grade: {
                        required : true,
                    },

                    certificate: {
                        required : true,
                    },



                },
                messages :{
                    institutionName: {
                        required : 'Institution Name Required',
                    },

                    startDate: {
                        required : 'Start Date Required',
                    },
                    exitDate: {
                        required : 'Start Date Required',
                    },
                    courseName: {
                        required : 'Course Name Required',
                    },
                    grade: {
                        required : 'Grade Attained Required',
                    },

                    certificate: {
                        required : 'Certificate Required',
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
@endsection
