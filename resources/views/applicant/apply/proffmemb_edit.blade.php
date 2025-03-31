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
                        <form method="post" id="myForm" action="{{ route('proffmembership.update') }}" enctype="multipart/form-data">                                    @csrf
                                @csrf
                            <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> Update Membership To Proffessional Body</h5>
                            <input type="text" hidden="" name="id" value="{{$proffmemb->id}}">
                            <input type="text" hidden=""  name="oldcert" value="{{$proffmemb->certificate}}">
                            <div class="row">


                                <div class="col-md-6">
                                    <div class="mb-3 form-group">
                                        <label for="proffBody" class="form-label">Proffessional Body</label>
                                        <input type="text" name="proffBody" id="proffBody" class="form-control" value="{{$proffmemb->proffBody}}" placeholder="Professional Body"   >
                                        @error('proffBody')
                                        <span class="text-danger"> {{ $message }} </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3 form-group">
                                        <label for="memberNumber" class="form-label">Membership Number  </label>
                                        <input type="text" name="memberNumber" id="memberNumber" value="{{$proffmemb->memberNumber}}" class="form-control" placeholder="Course Name"  >

                                    </div>
                                </div>













                                <div class="col-md-6">
                                    <div class="mb-3 form-group">
                                        <a href="{{asset($proffmemb->memberCertificate)}}" target="_blank">Uploaded Certificate</a>
                                    </div>
                                </div> <!-- end col -->



                                <div class="col-md-6">
                                    <div class="mb-3 form-group">
                                        <label for="memberCertificate" class="form-label">Change Uploaded Certificate in PDF Format.Ensure document is less than 1mb</label>
                                        <input type="file" name="memberCertificate" id="memberCertificate" class="form-control"  accept="application/pdf">
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
                    proffBody: {
                        required : true,
                    },

                    memberNumber: {
                        required : true,
                    },






                },
                messages :{
                    proffBody: {
                        required : 'Institution Name Required',
                    },

                    memberNumber: {
                        required : 'Membership Number Required',
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
