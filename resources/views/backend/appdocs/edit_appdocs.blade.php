@extends('admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Edit Document </a></li>

                            </ol>
                        </div>
                        <h4 class="page-title">Edit Application Document</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">


                <div class="col-lg-8 col-xl-12">
                    <div class="card">
                        <div class="card-body">





                            <!-- end timeline content-->

                            <div class="tab-pane" id="settings">
                                <form method="post" action="{{ route('appdocs.update') }}" >
                                    @csrf

                                    <input type="hidden" name="id" value="{{ $appdoc->id }}">

                                    <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> Edit Document</h5>

                                    <div class="row">


                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">Document Name</label>
                                                <input type="text" name="document_name" value="{{$appdoc->document_name}}" class="form-control" id="document_name"   >

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="driving" class="form-label">Job Specific?   </label>
                                                <select name="job_specific" class="form-select" id="job_specific">
                                                    <option selected disabled >Select Status </option>
                                                    <option value=1 {{$appdoc->job_specific==1?"selected":""}}>Yes</option>
                                                    <option value=0 {{$appdoc->job_specific==0?"selected":""}}>No</option>

                                                </select>

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="driving" class="form-label">Active By Default?   </label>
                                                <select name="active" class="form-select" id="active">
                                                    <option selected disabled >Select Status </option>
                                                    <option value=1 {{$appdoc->active==1?"selected":""}}>Yes</option>
                                                    <option value=0 {{$appdoc->active==0?"selected":""}}>No</option>

                                                </select>

                                            </div>
                                        </div>








                                    </div> <!-- end row -->

                                    <div class="text-end">
                                        <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i class="mdi mdi-content-save"></i> Save</button>
                                    </div>
                                </form>
                            </div>
                            <!-- end settings content-->


                        </div>
                    </div> <!-- end card-->

                </div> <!-- end col -->
            </div>
            <!-- end row-->

        </div> <!-- container -->

    </div> <!-- content -->


    <script type="text/javascript">
        $(document).ready(function (){
            $('#myForm').validate({
                rules: {
                    document_name: {
                        required : true,
                    },
                    job_specific: {
                        required : true,
                    },


                    active: {
                        required : true,
                    },




                },
                messages :{
                    document_name: {
                        required : 'Document Name Required',
                    },
                    job_specific: {
                        required : 'Required',
                    },

                    active: {
                        required : 'Start Date Required',
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
