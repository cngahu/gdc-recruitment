@extends('admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <div class="row">


        <div class="col-lg-8 col-xl-12">
            <div class="card">
                <div class="card-body">





                    <!-- end timeline content-->

                    <div class="tab-pane">
                        <form method="post" id="myForm" action="{{ route('recruitment.updateextend') }}" enctype="multipart/form-data" >
                            @csrf
                    <input type="hidden" value="{{$recruitment->id}}" name="id">
                            <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> Edit Recruitment</h5>

                            <div class="row">


                                <div class="col-md-12">
                                    <div class="mb-3 form-group">
                                        <label for="name" class="form-label">Recruitment Name</label>
                                        <input type="text" name="name" id="name" disabled value="{{$recruitment->name}}" class="form-control"   >

                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="mb-3 form-group">
                                        <label for="description" class="form-label">Recruitment Description</label>
                                        <input type="text" name="description" disabled value="{{$recruitment->description}}" id="description" class="form-control"   >

                                    </div>
                                </div>



                                <div class="col-md-12">
                                    <div class="mb-3 form-group">
                                        <label for="startDate" class="form-label">Open date   </label>
                                        <input  type="date" id="date_picker" disabled name="startDate" value="{{$recruitment->startDate}}" class="form-control"  placeholder="Start Date" />

                                    </div>
                                </div>



                                <div class="col-md-12">
                                    <div class="mb-3 form-group">
                                        <label for="closeDate" class="form-label">Extended To Date  </label>
                                        <input  type="date" id="date_picker" name="closeDate" value="{{$recruitment->closeDate}}" class="form-control" />

                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="mb-3 form-group">
                                        <label for="ext_certificate" class="form-label">Upload Justification for Extension</label>
                                        <input type="file" name="ext_certificate" id="ext_certificate" class="form-control"  accept="application/pdf">

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






    <script type="text/javascript">
        $(document).ready(function (){
            $('#myForm').validate({
                rules: {


                    closeDate: {
                        required : true,
                    },


                    ext_certificate: {
                        required : true,
                    },


                },
                messages :{

                    closeDate: {
                        required : 'Closing Date Required',
                    },
                    ext_certificate: {
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
