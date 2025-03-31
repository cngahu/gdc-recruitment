@extends('applicant.applicant_dashboard')
@section('applicant')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <div class="row">


        <div class="col-lg-8 col-xl-12">
            <div class="card">
                <div class="card-body">

                    <!-- end timeline content-->

                    <div class="tab-pane">
                        <form method="post" id="myForm" action="{{ route('experience.update') }}" enctype="multipart/form-data">                                    @csrf
                        @csrf
                            <input type="hidden" name="id" value="{{ $experience->id }}">
                            <input type="hidden" name="current" value="{{ $experience->isCurrent }}">
                            <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> Add Work Experience</h5>

                            <div class="row">


                                <div class="col-md-6">
                                    <div class="mb-3 form-group">
                                        <label for="company" class="form-label">Name of Company/Organization</label>
                                        <input type="text" name="company" id="company" class="form-control"  value="{{$experience->company}}" >

                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3 form-group">
                                        <label for="jobTitle" class="form-label">Job Title</label>
                                        <input type="text" name="jobTitle" id="jobTitle" class="form-control"  value="{{$experience->jobTitle}}"  >

                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <label for="Duties" class="form-label">Duties/Responsibilities</label>
                                    <div class="mb-3">
                                        <label for="inputProductDescription" class="form-label">Long Description</label>
                                        <textarea id="mytextarea" name="Duties">{!! $experience->Duties !!}</textarea>

                                    </div>


                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3 form-group">
                                        <label for="startDate" class="form-label">Start date   </label>
                                        <input  type="date" id="date_picker" name="startDate" class="form-control"  value="{{$experience->startDate}}"  />

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="city" class="form-label"style="font-size:large">Is this your current job?</label>
                                    <div class="form-group">
                                        <select   class="form-control">

                                            <option  disabled="" value="Yes" {{ $experience->isCurrent == 1 ? 'selected' : '' }}>Yes</option>
                                            <option disabled="" value="No" {{ $experience->isCurrent == 0 ? 'selected' : '' }}>No</option>

                                        </select>
                                    </div>
                                </div>
                                @if($experience->isCurrent==0)
                              <div class="row"  id="currentjob">
                                  <div class="col-md-6">
                                      <div class="mb-3 form-group">
                                          <label for="firstname" class="form-label">Exit date   </label>
                                          <input  type="date" id="date_picker" name="exitDate"  class="form-control"  value="{{$experience->exitDate}}" />

                                      </div>
                                  </div>


                                  <div class="col-md-6">
                                      <div class="mb-3 form-group">
                                          <label for="firstname" class="form-label">Exit Reasons   </label>
                                          <input type="text" name="exitReasons" id="exitReasons" class="form-control " value="{{$experience->exitReasons}}"  >

                                      </div>
                                  </div>
                              </div>
                                @endif

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



    <script>
        $(function () {

            $('#current').on('change', function() {

                if ( this.value == "No" )
                {
                    $("#currentjob").show();


                }
                else
                {
                    $("#currentjob").hide();


                }


            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function (){
            $('#myForm').validate({
                rules: {
                    company: {
                        required : true,
                    },
                    jobTitle: {
                        required : true,
                    },
                    Duties: {
                        required : true,
                    },
                    startDate: {
                        required : true,
                    },


                    current: {
                        required : true,
                    },



                    exitDate: {
                        required : function(element){
                            return Number(($('#current').val()=="No"));
                        },
                    },
                    exitReasons: {
                        required : function(element){
                            return Number(($('#current').val()=="No"));
                        },
                    },


                },
                messages :{
                    company: {
                        required : 'Institution Name Required',
                    },
                    jobTitle: {
                        required : 'Job Title Required',
                    },
                    startDate: {
                        required : 'Start Date Required',
                    },
                    exitDate: {
                        required : 'Exit Date Required',
                    },
                    Duties: {
                        required : 'Duties Required',
                    },
                    exitReasons: {
                        required : 'Exit Reasons Required',
                    },
                    current: {
                        required : 'This Option is Required',
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
