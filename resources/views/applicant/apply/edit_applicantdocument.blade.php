@extends('applicant.applicant_dashboard')
@section('applicant')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <div class="row">


        <div class="col-lg-8 col-xl-12">
            <div class="card">
                <div class="card-body">





                    <!-- end timeline content-->

                    <div class="tab-pane">
                        <form method="post" id="myForm" action="{{ route('applicantdoc.update') }}" enctype="multipart/form-data">                                    @csrf
                                @csrf
                            <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> Update Education Qualification</h5>
                            <input type="text" hidden="" name="id" value="{{$appdoc->id}}">
                            <input type="text" hidden=""  name="oldcert" value="{{$appdoc->path}}">
                            <div class="row">


                                <div class="col-md-6">
                                    <div class="mb-3 form-group">
                                        <label for="certificate" class="form-label">Change {{$appdoc['document']['document_name']}} in PDF Format.Ensure document is less than 1mb</label>
                                        <input type="file" name="certificate" id="certificate" class="form-control"  required accept="application/pdf">
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

                    certificate: {
                        required : true,
                    },



                },
                messages :{

                    certificate: {
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
@endsection
