@extends('admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <div class="row">


        <div class="col-lg-8 col-xl-12">
            <div class="card">
                <div class="card-body">

                    <!-- end timeline content-->

                    <div class="tab-pane">
                        <form method="post" id="myForm" action="{{ route('vacancies.store') }}" >

                            @csrf
                            <input type="hidden" name="recruitmentid" value="{{$id}}">
                            <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> Add Vacancy</h5>

                            <div class="row">


                                <div class="col-md-12">
                                    <div class="mb-3 form-group">
                                        <label for="jobTitle" class="form-label">Job Title</label>
                                        <input type="text" name="jobTitle" id="jobTitle" class="form-control @error('jobTitle') is-invalid @enderror"   >
                                        @error('jobTitle')
                                        <span class="text-danger"> {{ $message }} </span>
                                        @enderror
                                    </div>
                                </div>
{{--                                <div class="col-md-12">--}}
{{--                                    <div class="mb-3 form-group">--}}
{{--                                        <label for="salary" class="form-label">Gross Salary</label>--}}
{{--                                        <input type="number" maxlength="6" value="" name="salary" id="salary" class="form-control @error('jobTitle') is-invalid @enderror"   >--}}

{{--                                    </div>--}}
{{--                                </div>--}}

                                <div class="col-md-12">
                                    <div class="mb-3 form-group">
                                        <label for="min_salary" class="form-label">Minimum Salary</label>
                                        <input type="number" maxlength="6" value="" name="min_salary" id="min_salary" class="form-control  @error('min_salary') is-invalid @enderror" >
                                        @error('min_salary')
                                        <span class="text-danger"> {{ $message }} </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="mb-3 form-group">
                                        <label for="max_salary" class="form-label">Maximum Salary</label>
                                        <input type="number" maxlength="6" value="" name="max_salary" id="max_salary" class="form-control  @error('max_salary') is-invalid @enderror">
                                        @error('max_salary')
                                        <span class="text-danger"> {{ $message }} </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="mb-3 form-group">
                                        <label for="jobDescription" class="form-label">Job Description</label>
{{--                                        <textarea id="jobDescription" name="jobDescription" rows="4" cols="50" class="form-control @error('jobDescription') is-invalid @enderror" >--}}
{{--                                        </textarea>--}}
                                        <textarea id="mytextarea" name="jobDescription">Job Description</textarea>

                                        @error('jobDescription')
                                        <span class="text-danger"> {{ $message }} </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="mb-3 form-group">
                                        <label for="jobSpecification" class="form-label">Job Specification</label>
{{--                                        <textarea id="jobSpecification" name="jobSpecification" rows="4" cols="50" class="form-control @error('jobSpecification') is-invalid @enderror" >--}}
{{--                                        </textarea>--}}
                                        <textarea id="mytextarea" name="jobSpecification">Job Specification</textarea>

                                        @error('jobSpecification')
                                        <span class="text-danger"> {{ $message }} </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="mb-3 form-group">
                                        <label for="positionCode" class="form-label">JOB Grade</label>
                                        <input type="number" minlength="1" maxlength="2" name="positionCode" id="positionCode" class="form-control @error('positionCode') is-invalid @enderror"   >
                                        @error('positionCode')
                                        <span class="text-danger"> {{ $message }} </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="mb-3 form-group">
                                        <label for="Positions" class="form-label">No of Positions</label>
                                        <input type="number" name="Positions" id="Positions" class="form-control @error('Positions') is-invalid @enderror"   >
                                        @error('Positions')
                                        <span class="text-danger"> {{ $message }} </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="mb-3 form-group">
                                        <label for="VacancyReference" class="form-label">Vacancy Ref</label>
                                        <input type="text" name="VacancyReference" id="VacancyReference" class="form-control @error('VacancyReference') is-invalid @enderror"   >
                                        @error('VacancyReference')
                                        <span class="text-danger"> {{ $message }} </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="mb-3 form-group">
                                    <label for="jobtype" class="form-label">Terms of Engagement  </label>
                                    <select name="jobtype" class="form-select @error('jobtype') is-invalid @enderror" id="example-select">
                                        <option selected disabled >Select Status </option>
                                        <option value="Permanent and Pensionable">Permanent and Pensionable</option>
                                        <option value="Contract">Contract</option>

                                    </select>
                                    @error('jobtype')
                                    <span class="text-danger"> {{ $message }} </span>
                                    @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3 form-group">
                                        <label for="jobt_ype" class="form-label">Type  </label>
                                        <select name="job_type" class="form-select @error('job_type') is-invalid @enderror" id="example-select">
                                            <option selected disabled >Select Type </option>
                                            <option value="Internal">Internal</option>
                                            <option value="External">External</option>

                                        </select>
                                        @error('job_type')
                                        <span class="text-danger"> {{ $message }} </span>
                                        @enderror
                                    </div>
                                </div>
{{--                                <div class="col-md-12">--}}
{{--                                    <div class="mb-3 form-group">--}}
{{--                                        <label for="competence" class="form-label">Job Competences</label>--}}
{{--                                        <textarea id="competence" name="competence" rows="4" cols="50" class="form-control @error('competence') is-invalid @enderror" >--}}
{{--                                        </textarea>--}}
{{--                                        @error('competence')--}}
{{--                                        <span class="text-danger"> {{ $message }} </span>--}}
{{--                                        @enderror--}}
{{--                                    </div>--}}
{{--                                </div>--}}

                                <div class="col-md-12">
                                    <label for="competence" class="form-label">Select Upload Documents</label>
                                    @foreach($appdocs as $key=> $item)
                                        <div class="form-check">
                                            <input type="checkbox" style="font-size: large" value="1" class="form-check-input" id="customCheck1" name="fileid[{{$item->id}}]" >
                                            <label class="form-check-label" for="customCheck1">{{$item->document_name}}</label>
                                        </div>

                                    @endforeach
                                </div>


                                <div class="text-end">
                                    <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i class="mdi mdi-content-save"></i> Save</button>
                                </div>


                            </div>





                    </div>
                </div> <!-- end card-->

            </div> <!-- end col -->
        </div>


    <script type="text/javascript">
        $(document).ready(function (){
            $('#myForm').validate({
                rules: {
                    jobTitle: {
                        required : true,
                    },
                    mytextarea: {
                        required : true,
                    },
                    jobtype: {
                        required : true,
                    },
                    job_type: {
                        required : true,
                    },

                    // salary: {
                    //     required : true,
                    // },

                    jobSpecification: {
                        required : true,
                    },
                    positionCode: {
                        required : true,
                    },
                    Positions: {
                        required : true,
                    },
                    VacancyReference: {
                        required : true,
                    },

                },
                messages :{
                    jobTitle: {
                        required : 'Job Title  Required',
                    },
                    jobDescription: {
                        required : 'Job Description Required',
                    },
                    jobtype: {
                        required : ' Required',
                    },
                    job_type: {
                        required : ' Internal/External Required',
                    },


                    jobSpecification: {
                        required : 'Job Specification Required',
                    },
                    positionCode: {
                        required : 'Position Code Required',
                    },
                    Positions: {
                        required : 'Number of positions  is required',
                    },
                    VacancyReference: {
                        required : 'Vacancy Reference Required',
                    },
                    // salary: {
                    //     required : 'Salary Required',
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
