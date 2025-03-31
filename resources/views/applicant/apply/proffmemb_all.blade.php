@extends('applicant.applicant_dashboard')
@section('applicant')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <div class="row">
        <h5 style="color:seagreen">Step 4 of 7</h5>
        <div class="alert alert-danger text-center" role="alert">
            <p>Dear Applicant, please ensure to add your membership details for the professional body.</p>
            <p>
                Fields marked with a <span style="color: red;">*</span> are mandatory for successful submission. Please provide the required details and proceed accordingly.
            </p>
        </div>
        <div class="col-lg-8 col-xl-12">
            <div class="card">
                <div class="card-body">


                    <div class="row">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="customCheck2"  >
                            <label class="form-check-label" style="color: red" for="customCheck2">Click Here If You Do Not Belong To Any Proffessional Membership Body</label>
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



                    <div class="tab-pane" id="proffmembdiv">
                        <form method="post" id="myForm" action="{{ route('proffmembership.store') }}" enctype="multipart/form-data">                                    @csrf
@csrf
                            <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> Add Membership To Proffessional Body</h5>

                            <div class="row">


                                <div class="col-md-6">
                                    <div class="mb-3 form-group">
                                        <label for="proffBody" class="form-label">Proffessional Body <span style="color: red;">*</span></label>
                                        <input type="text" name="proffBody" id="proffBody" class="form-control" placeholder="Professional Body"   >
                                        @error('proffBody')
                                        <span class="text-danger"> {{ $message }} </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3 form-group">
                                        <label for="memberNumber" class="form-label">Membership Number <span style="color: red;">*</span> </label>
                                        <input type="text" name="memberNumber" id="memberNumber" class="form-control" placeholder="Course Name"  >

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3 form-group">
                                        <label for="active" class="form-label">Membership Status  <span style="color: red;">*</span></label>
                                        <select name="active" id="active" required="" class="form-control">
                                            <option value="" selected="" disabled="">Select Status</option>
                                            <option value=1>Active</option>
                                            <option value=0>Not Active</option>

                                        </select>
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="mb-3 form-group">
                                        <label for="memberCertificate" class="form-label">Upload Certificate in PDF Format.Ensure document is less than 1mb <span style="color: red;">*</span></label>
                                        <input type="file" name="memberCertificate" id="memberCertificate" class="form-control"  accept="application/pdf">
                                    </div>
                                </div> <!-- end col -->




                            </div> <!-- end row -->


                        @if(count($proff_memb)==0)


                            <div class="text-end">
                                <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i class="mdi mdi-content-save"></i> Save</button>
                            </div>
                            @else
                                <div class="text-end">

                                    <a href="{{route('applicant.proffessionalqual')}}" class="btn btn-primary">Previous</a>
                                    <button type="submit"  class="btn btn-success "> Save And Add Another</button>
                                    <a href="{{route('applicant.experience')}}" class="btn btn-warning">Proceed To Next Stage</a>

                                </div>

                            @endif
                        </form>
                    </div>
                    <div class="" id="proceed">
                        <form method="post" action="{{route('proffmembership.noquals')}}">
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
    @if((($ccount>0)&&($user->no_membership==1)))

    <div class="row">
        <div class="col-12">
            <!-- Portlet card -->
            <div class="card">
                <div class="card-body">
                    <div class="card-widgets">
                        <a href="javascript: void(0);" data-toggle="reload"><i class="mdi mdi-refresh"></i></a>
                        <a data-bs-toggle="collapse" href="#cardCollpase4" role="button" aria-expanded="false" aria-controls="cardCollpase4"><i class="mdi mdi-minus"></i></a>
                    </div>
                    <h4 class="header-title mb-0">My Proffessional Memberships</h4>

                    <div id="cardCollpase4" class="collapse show">
                        <div class="table-responsive pt-3">
                            <table class="table table-centered table-nowrap table-borderless mb-0">
                                <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Professional Body</th>
                                    <th>Membership Number</th>
                                    <th>Status</th>
                                    <th>Certificate</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($proff_memb as $key=> $item)
                                <tr class=".table-striped">
                                    <td> {{ $key+1 }} </td>
                                    <td>{{$item->proffBody}}</td>
                                    <td>{{$item->memberNumber}}</td>
                                    <td>
                                        @if($item->active == 0)
                    <span class="badge badge-pill bg-danger"> Not Active </span>


                                        @else
                <span class="badge badge-pill bg-success">       Active </span>

                                        @endif



{{--                                        {{$item->memberNumber}}--}}
                                    </td>

                                    <td><a href="{{asset($item->memberCertificate)}}" target="_blank" >Certificate</a> </td>

                                    <td>
                                        <a href="{{route('proffmembership.edit',$item->id)}}" class="btn btn-primary"><i class="material-symbols-outlined">edit</i></a>
                                        <a href="{{route('proffmembership.delete',$item->id)}}" class="btn btn-danger"  id="delete" ><i class="material-symbols-outlined">delete</i></a>

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

    @elseif(($ccount==0)&&($user->no_membership==0))
        <div class="col-12">
            <!-- Portlet card -->
            <div class="card">
                <div class="card-body">
                    <div class="card-widgets">
                        <a href="javascript: void(0);" data-toggle="reload"><i class="mdi mdi-refresh"></i></a>
                        <a data-bs-toggle="collapse" href="#cardCollpase4" role="button" aria-expanded="false" aria-controls="cardCollpase4"><i class="mdi mdi-minus"></i></a>
                    </div>
                    <h4 class="header-title mb-0">My Proffessional Memberships</h4>
                    <br>
                    <div class="alert alert-warning bg-warning text-white border-0" role="alert">
                        <strong>You Do Not Have Any Proffessional Memberships ! </strong>
                    </div>
                    <div>
                        <a href="{{route('applicant.proffessionalqual')}}" class="btn btn-primary">Previous</a>

                        <a href="{{route('applicant.experience')}}" class="btn btn-success">Proceed To Next Stage</a>

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
                    <h4 class="header-title mb-0">My Proffessional Memberships</h4>
                    <br>
                    <div class="alert alert-warning bg-warning text-white border-0" role="alert">
                        <strong>You Do Not Have Any Proffessional Memberships ! </strong>
                    </div>


                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->
    @endif


    <script>
        $('#customCheck2').change(function() {
            if(this.checked) {
                $("#proffmembdiv").hide();
                $("#proceed").show();

            }
            else
            {
                $("#proffmembdiv").show();
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
                    proffBody: {
                        required : true,
                    },

                    memberNumber: {
                        required : true,
                    },


                    memberCertificate: {
                        required : true,
                    },
                    active: {
                        required : true,
                    },



                },
                messages :{
                    proffBody: {
                        required : 'Institution Name Required',
                    },
                    active: {
                        required : 'Select Membership Activeness',
                    },

                    memberNumber: {
                        required : 'Membership Number Required',
                    },

                    memberCertificate: {
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
