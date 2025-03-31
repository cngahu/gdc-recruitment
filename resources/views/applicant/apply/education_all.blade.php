@extends('applicant.applicant_dashboard')
@section('applicant')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <div class="row">
        <h5 style="color:seagreen">Step 2 of 7</h5>

        <div class="col-lg-8 col-xl-12">
            <div class="card">
                <div class="card-body">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                        <div class="alert alert-danger text-center" role="alert">
                            <p>Dear Applicant, please use this page to enter your Academic Qualifications.</p>
                            <p>
                                Begin with your highest qualification and proceed in descending order. Academic qualifications refer to educational achievements such as your secondary or high school certificate (KCSE/A/O levels), as well as college diplomas, degrees, postgraduates, and higher diplomas.
                            </p>
                            <p>
                                After adding a qualification, repeat the process until all qualifications have been entered, then proceed to the next stage. Fields marked with a <span style="color: red;">*</span> are mandatory.
                            </p>
                        </div>


                    <!-- end timeline content-->

                    <div class="tab-pane">
                        <form method="post" id="myForm" action="{{ route('education.store') }}" enctype="multipart/form-data">                                    @csrf
@csrf
                            <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> Add Education Qualification</h5>
                            <!-- Notification Message -->

{{--                            <div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show" role="alert">--}}
{{--                              Upon Adding your first education qualification, repeat the same process to add more academic qualifications!--}}
{{--                            </div>--}}
                            <div class="row">


                                <div class="col-md-6">
                                    <div class="mb-3 form-group">
                                        <label for="firstname" class="form-label">Name of Institution <span style="color: red;">*</span></label>
                                        <input type="text" name="institutionName" id="institutionName" class="form-control @error('institutionName') is-invalid @enderror"   >
                                        @error('institutionName')
                                        <span class="text-danger"> {{ $message }} </span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="mb-3 form-group">
                                        <label for="academiclevel" class="form-label">Academic Level <span style="color: red;">*</span> </label>
                                        <select name="academiclevel"  id="academiclevel" required="" class="form-control">
                                            <option value="" selected="" disabled="">Select </option>
                                            @foreach($academiclevels as $item)
                                                <option value="{{$item->id }}">{{$item->name}}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>




{{--                                <div class="col-md-6">--}}
{{--                                    <div class="mb-3 form-group">--}}
{{--                                        <label for="startDate" class="form-label">Start date   </label>--}}
{{--                                        <input  type="date" id="date_picker" name="startDate" value="" class="form-control"  placeholder="Start Date" />--}}

{{--                                    </div>--}}
{{--                                </div>--}}

                                <div class="col-md-6">
                                    <div class="mb-3 form-group">
                                        <label for="firstname" class="form-label">Exit date /Completion Date  <span style="color: red;">*</span></label>
                                        <input  type="date" id="date_picker" name="exitDate" value="" class="form-control"  placeholder="Exit Date" />

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3 form-group">
                                        <label for="academiclevel" class="form-label">Course Category  <span style="color: red;">*</span></label>
                                        <select name="course_category"  id="course_category" required="" class="form-control">
                                            <option value="" selected="" disabled="">Select </option>
                                            @foreach($categories as $item)
                                                <option value="{{$item->id }}">{{$item->name}}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3 form-group">
                                        <label for="firstname" class="form-label">Course Name   <span style="color: red;">*</span></label>
                                        <input type="text" name="courseName" id="courseName" class="form-control @error('courseName') is-invalid @enderror" placeholder="Course Name"  >

                                    </div>
                                </div>



                                <div class="col-md-6">
                                    <div class="mb-3 form-group">
                                        <label for="grade" class="form-label">Grade Attained  <span style="color: red;">*</span></label>
                                        <select name="grade"  id="grade" required="" class="form-control">
                                            <option value="" selected="" disabled="">Select </option>
                                            @foreach($grade as $item)
                                                <option value="{{$item->id }}">{{$item->name}}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="mb-3 form-group">
                                        <label for="certNo" class="form-label">Certificate Number  <span style="color: red;">*</span></label>
                                        <input type="text" name="certNo" id="certNo" class="form-control @error('certNo') is-invalid @enderror" placeholder="Certificate Number"  >

                                    </div>
                                </div>



                                <div class="col-md-6">
                                    <div class="mb-3 form-group">
                                        <label for="certificate" class="form-label">Upload Certificate in PDF Format.Ensure document is less than 2mbs <span style="color: red;">*</span></label>
                                        <input type="file" name="certificate" id="certificate" class="form-control"  accept="application/pdf">
                                    </div>
                                </div> <!-- end col -->




                            </div> <!-- end row -->


                        @if(count($edu_profile)==0)


                                <div class="col-12" id="buttonsdiv">
                                    <button type="submit" style="width: 100%" class="btn btn-success " style="font-size:large">Submit</button>
                                </div>
                            @else
                                <div class="text-end">

                                    <a href="{{route('applicant.profile',$userid)}}" class="btn btn-primary">Previous</a>
                                    <button type="submit" id="buttonsdiv"  class="btn btn-success "> Save And Add Another</button>
                                    <a href="{{route('applicant.proffessionalqual')}}" class="btn btn-warning">Proceed To Next Stage</a>

                                </div>

                            @endif
                        </form>
                    </div>
                    <!-- end settings content-->


                </div>
            </div> <!-- end card-->

        </div> <!-- end col -->
    </div>

    <div class="row">
        <div class="col-12">
            <!-- Portlet card -->
            <div class="card">
                <div class="card-body">
                    <div class="card-widgets">
                        <a href="javascript: void(0);" data-toggle="reload"><i class="mdi mdi-refresh"></i></a>
                        <a data-bs-toggle="collapse" href="#cardCollpase4" role="button" aria-expanded="false" aria-controls="cardCollpase4"><i class="mdi mdi-minus"></i></a>
                    </div>
                    <h4 class="header-title mb-0">My Academic Qualifications</h4>

                    <div id="cardCollpase4" class="collapse show">
                        <div class="table-responsive pt-3">
                            <table class="table table-centered table-nowrap table-borderless mb-0">
                                <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Institution</th>
                                    <th>Level</th>
                                    <th>Course</th>
                                    <th>Exit Date</th>
                                    <th>Grade</th>
                                    {{--                                    <th>Certificate No</th>--}}
                                    <th>Certificate</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($edu_profile as $key=> $item)
                                    <tr class=".table-striped">
                                        <td> {{ $key+1 }} </td>
                                        <td>{{$item->institutionName}}</td>
                                        <td>{{$item['assign_academiclevel']['name']}}</td>
                                        <td>{{$item->courseName}}</td>
                                        <td>{{$item->exitDate}}</td>
                                        <td>{{$item['assign_grade']['name']}}</td>
                                        {{--                                    <td>{{$item->certNo}}</td>--}}
                                        <td><a href="{{asset($item->certificate)}}" target="_blank" >Certificate</a> </td>

                                        <td>
                                            <a href="{{route('education.edit',$item->id)}}" class="btn btn-primary"><i class="material-symbols-outlined">edit</i></a>
                                            <a href="{{route('education.delete',$item->id)}}" class="btn btn-danger"  id="delete" ><i class="material-symbols-outlined">delete</i></a>

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




    <script type="text/javascript">
        $(document).ready(function (){
            $('#myForm').validate({
                rules: {
                    institutionName: {
                        required : true,
                    },
                    academiclevel: {
                        required : true,
                    },
                    // startDate: {
                    //     required : true,
                    // },

                    course_category: {
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
                    certNo: {
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
                    academiclevel: {
                        required : 'Academic Level Required',
                    },
                    // startDate: {
                    //     required : 'Start Date Required',
                    // },
                    exitDate: {
                        required : 'Start Date Required',
                    },
                    courseName: {
                        required : 'Course Name Required',
                    },
                    grade: {
                        required : 'Grade Attained Required',
                    },
                    certNo: {
                        required : 'Certificate Number Required',
                    },
                    course_category: {
                        required : 'Course Category Required',
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
    <script>
        $(function() {
            $("#date_picker1").datepicker({
                dateFormat: 'dd/mm/yyyy' // Specify your desired date format here
            });
        });
    </script>
@endsection
