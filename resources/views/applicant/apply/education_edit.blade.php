@extends('applicant.applicant_dashboard')
@section('applicant')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <div class="row">


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


                    <!-- end timeline content-->

                    <div class="tab-pane">
                        <form method="post" id="myForm" action="{{ route('education.update') }}" enctype="multipart/form-data">                                    @csrf
                                @csrf
                            <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> Update Education Qualification</h5>
                            <input type="text" hidden="" name="id" value="{{$education->id}}">
                            <input type="text" hidden=""  name="oldcert" value="{{$education->certificate}}">
                            <div class="row">


                                <div class="col-md-6">
                                    <div class="mb-3 form-group">
                                        <label for="firstname" class="form-label">Name of Institution</label>
                                        <input type="text" name="institutionName" id="institutionName" value="{{$education->institutionName}}" class="form-control">

                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="mb-3 form-group">
                                        <label for="academiclevel" class="form-label">Academic Level  </label>
                                        <select name="academiclevel"  id="academiclevel" required="" class="form-control">
                                            <option value="" selected="" disabled="">Select </option>
                                            @foreach($academiclevels as $item)
                                                <option value="{{$item->id }}" {{ $education->academiclevel == $item->id ? 'selected' : '' }}>{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('academiclevel')
                                        <span class="text-danger"> {{ $message }} </span>
                                        @enderror
                                    </div>
                                </div>




{{--                                <div class="col-md-6">--}}
{{--                                    <div class="mb-3 form-group">--}}
{{--                                        <label for="startDate" class="form-label">Start date   </label>--}}
{{--                                        <input  type="date" id="date_picker" name="startDate" value="{{$education->startDate}}" class="form-control">--}}

{{--                                    </div>--}}
{{--                                </div>--}}

                                <div class="col-md-6">
                                    <div class="mb-3 form-group">
                                        <label for="firstname" class="form-label">Exit date /Completion Date  </label>
                                        <input  type="date" id="date_picker" name="exitDate" value="{{$education->exitDate}}" class="form-control">

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3 form-group">
                                        <label for="course_category" class="form-label">Course Category  </label>
                                        <select name="course_category"  id="course_category" class="form-control">
                                            <option value="" selected="" disabled="">Select </option>
                                            @foreach($categories as $item)
                                                <option value="{{$item->id}}" {{ $education->course_category == $item->id ? 'selected' : '' }}>{{$item->name}}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="mb-3 form-group">
                                        <label for="firstname" class="form-label">Course Name   </label>
                                        <input type="text" name="courseName" id="courseName" value="{{$education->courseName}} " class="form-control">

                                    </div>
                                </div>



                                <div class="col-md-6">
                                    <div class="mb-3 form-group">
                                        <label for="grade" class="form-label">Grade Attained  </label>
                                        <select name="grade"  id="grade" required="" class="form-control">
                                            <option value="" selected="" disabled="">Select </option>
                                            @foreach($grade as $item)
                                                <option value="{{$item->id }}"  {{ $education->grade == $item->id ? 'selected' : '' }}>{{$item->name}}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="mb-3 form-group">
                                        <label for="certNo" class="form-label">Certificate Number  </label>
                                        <input type="text" name="certNo" id="certNo" value="{{$education->certNo}}" class="form-control">

                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="mb-3 form-group">
                                        <a href="{{asset($education->certificate)}}" target="_blank">Uploaded Certificate</a>
                                    </div>
                                </div> <!-- end col -->


                                <div class="col-md-6">
                                    <div class="mb-3 form-group">
                                        <label for="certificate" class="form-label">Change Uploaded Certificate in PDF Format.Ensure document is less than 1mb</label>
                                        <input type="file" name="certificate" id="certificate" class="form-control"  accept="application/pdf">
                                    </div>
                                </div> <!-- end col -->




                            </div> <!-- end row -->



                            <div class="text-end">
                                <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i class="mdi mdi-content-save"></i> Update</button>
                            </div>
                        </form>
                    </div>
                    <!-- end settings content-->


                </div>
            </div> <!-- end card-->

        </div> <!-- end col -->
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
                    certNo: {
                        required : true,
                    },
                    // certificate: {
                    //     required : true,
                    // },
                    course_category: {
                        required : true,
                    },


                },
                messages :{
                    institutionName: {
                        required : 'Institution Name Required',
                    },
                    course_category: {
                        required : ' Required',
                    },
                    academiclevel: {
                        required : 'Academic Level Required',
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
                    certNo: {
                        required : 'Certificate Number Required',
                    },
                    // certificate: {
                    //     required : 'Certificate Required',
                    // },



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
