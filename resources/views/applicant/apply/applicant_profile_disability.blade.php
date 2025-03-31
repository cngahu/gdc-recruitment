
@extends('applicant.applicant_dashboard')
@section('applicant')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

  <div class="row">

      <h3>Personal Details</h3>
      <div class="page-content">

          <div class="card border-top border-left  border-0 border-4 border-success">
              <div class="card-body ">

                  <form class="row " id="myForm"  method="post"   action="{{ route('profile.update.disability') }}" enctype="multipart/form-data">
                      @csrf
                      <input hidden="" name="userid" value="{{$user->id}}">


                      <div class="row">
                          <div class="col-md-3">
                              <label for="inputLastName2" class="form-label" >Applicant Name</label>
                              <div class="form-group">
                                  <input type="text" style="background-color: grey;color: whitesmoke" name="first_name" value="{{$user->first_name}}" disabled class="form-control border-start-0" />
                              </div>
                          </div>
                          <div class="col-md-3">
                              <label for="inputLastName2" class="form-label" >Applicant Other Name</label>
                              <div class="form-group">
                                  <input type="text" style="background-color: grey;color: whitesmoke"  name="other_name" value="{{$user->other_name}}" disabled class="form-control border-start-0" />
                              </div>
                          </div>
                          <div class="col-md-3">
                              <label for="inputLastName2" class="form-label" >Applicant Last Name</label>
                              <div class="form-group">
                                  <input type="text" style="background-color: grey;color: whitesmoke"  name="last_name" value="{{$user->last_name}}" disabled class="form-control border-start-0" />
                              </div>
                          </div>
                          <br>
                          <div class="col-md-3">
                              <label for="inputLastName2" class="form-label"  >Email Address</label>
                              <div class="form-group">
                                  <input type="text" name="email" style="background-color: grey;color: whitesmoke"  value="{{$user->email}}" disabled class="form-control border-start-0" />
                              </div>
                          </div>

                      </div>

                      <div class="row">


                          <div class="col-md-4">
                              <label for="city" class="form-label" >Do you Have Any Disability?</label>
                              <div class="form-group">
                                  <select  style="background-color: grey;color: whitesmoke" disabled required="" class="form-control">
                                      <option value="" selected="" disabled="">Select Status</option>
                                      <option value="Yes" {{$user->disability=="Yes" ? 'selected':'' }}>Yes</option>
                                      <option value="No" {{$user->disability=="No" ? 'selected':'' }}>No</option>

                                  </select>
                              </div>
                          </div>



                      @if($user->disability=="Yes")
                          <div class="col-md-4"  >
                              <label for="disability_desc" class="form-label">Are you registered with The National Council for Persons with Disabilities (NCPWD) ?</label>
                              <div class="form-group">
                                  <select      style="background-color: grey;color: whitesmoke" required="" class="form-control">
                                      <option value="" selected="" disabled="">Select Status</option>
                                      <option value=1 {{$user->disability_reg==1? 'selected':'' }}>Yes</option>
                                      <option value=0 {{$user->disability_reg==0 ? 'selected':'' }}>No</option>

                                  </select>
                              </div>
                          </div>
                          @endif

                      </div>

                      <p></p>

                      @if($user->disability=="Yes" && $user->disability_reg==1)
                      <div class="row"  >

                          <div class="col-md-6">
                              <label for="inputLastName2" class="form-label" style="font-size:large" >Disability Registration Number</label>
                              <div class="form-group">
                                  <input      style="background-color: grey;color: whitesmoke"class="form-control" type="text"  placeholder="Disability Registration Number"  value="{{$user->disabilitydescription}}">
                              </div>
                          </div>
                          <div class="col-md-6">
                              <div class="mb-3 form-group">
{{--                                  <label for="reg_certificate" class="form-label">Uploaded Registration Certificate </label>--}}
{{--                                  <input type="file" name="reg_certificate" id="reg_certificate" class="form-control"  accept="application/pdf">--}}
                                    <a href="{{asset($user->disability_cert)}}" class="btn btn-primary" target="_blank">Click To View Uploaded Registration Certificate</a>
                              </div>
                          </div>


                      </div>
                      @elseif($user->disability=="Yes" && $user->disability_reg==0)
                      <div class="row" id="group3" >

                          <div class="col-md-6">
                              <label for="inputLastName2" class="form-label" style="font-size:large" >Describe your disability</label>
                              <div class="form-group">
                                  <input      style="background-color: grey;color: whitesmoke" value="{{$user->disability_desc}}" class="form-control" type="text"  placeholder="Disability Description" >

                              </div>
                          </div>



                      </div>

                      @endif
                      <p></p>
                      <div class="row">
                          <div class="col-md-4">
                              <label for="city" class="form-label" >Update Disability?</label>
                              <div class="form-group">
                                  <select name="disability" id="disability" required="" class="form-control">
                                      <option value="" selected="" disabled="">Select Status</option>
                                      <option value="Yes" >Yes</option>
                                      <option value="No" >No</option>

                                  </select>
                              </div>
                          </div>
                          <div class="col-md-4"  id="group2" style="display: none">
                              <label for="disability_desc" class="form-label"style="font-size:large">Are you registered with The National Council for Persons with Disabilities (NCPWD) ?</label>
                              <div class="form-group">
                                  <select name="disability_reg"  id="disability_reg" required="" class="form-control">
                                      <option value="" selected="" disabled="">Select Status</option>
                                      <option value=1>Yes</option>
                                      <option value=0>No</option>

                                  </select>
                              </div>
                          </div>
                      </div>
                      <p>
                      <div class="row" id="group1" style="display: none">

                          <div class="col-md-6">
                              <label for="inputLastName2" class="form-label" style="font-size:large" >Disability Registration Number</label>
                              <div class="form-group">
                                  <input name="disabilitydescription" class="form-control" type="text" id="disabilitydescription" placeholder="Disability Registration Number" >

                              </div>
                          </div>
                          <div class="col-md-6">
                              <div class="mb-3 form-group">
                                  <label for="reg_certificate" class="form-label">Upload Registration Certificate in PDF Format.Ensure document is less than 2mbs</label>
                                  <input type="file" name="reg_certificate" id="reg_certificate" class="form-control"  accept="application/pdf">

                              </div>
                          </div>


                      </div>
                      <div class="row" id="group3" style="display: none">

                          <div class="col-md-6">
                              <label for="inputLastName2" class="form-label" style="font-size:large" >Describe your disability</label>
                              <div class="form-group">
                                  <input name="disabilitydesc" class="form-control" type="text" id="disabilitydesc" placeholder="Disability Description" >

                              </div>
                          </div>



                      </div>
                      </p>
                      <p></p>

                      <div class="col-12" >
                          <button type="submit" style="width: 50%" class="btn btn-success form-group" style="font-size:large">Update</button>
                          <a href="{{route('applicant.dashboard')}}" class="btn btn-warning">Back To Dashboard</a>

                      </div>

                  </form>
              </div>
          </div>
      </div>
  </div>
    <script>
        $(function () {

            $('#disability').on('change', function() {

                if ( this.value == "Yes" )
                {
                    $("#group2").show();



                }
                else
                {

                    $("#group1").hide();
                    $("#group3").hide();
                    $("#group2").hide();

                }


            });

        });
        $(function () {

            $('#disability_reg').on('change', function() {

                if ( this.value == 1)
                {
                    $("#group1").show();
                    $("#group3").hide();

                    $("#disabilitydesc").val('');


                }
                else
                {
                    $("#group1").hide();
                    $("#group3").show();

                    $("#disabilitydescription").val('');
                    $("#reg_certificate").val('');


                }


            });
        });
    </script>
    <script language="javascript">
        var today = new Date();



        $('#date_picker').attr('max',today);
        $('#date_picker2').attr('max',today);
    </script>


    <script type="text/javascript">
        $(document).ready(function (){
            $('#myForm').validate({
                rules: {

                    disability: {
                        required : true,
                    },
                    disabilitydesc: {
                        required : function(element){
                            return Number(($('#disability').val()=="Yes"));
                        },
                    },


                    disabilitydescription: {
                        required : function(element){
                            return Number(($('#disability_reg').val()==1));
                        },
                    },
                    reg_certificate: {
                        required : function(element){
                            return Number(($('#disability_reg').val()==1));
                        },
                    },
                    disabilitydesc: {
                        required : function(element){
                            return Number(($('#disability_reg').val()==0));
                        },
                    },


                },
                messages :{

                    disability: {
                        required : 'Please Select Disability',
                    },
                    disabilitydesc: {
                        required : 'Required',
                    },
                    disability_reg: {
                        required : 'Required',
                    },



                    disabilitydescription: {
                        required : 'Please Enter Disability Description',
                    },
                    reg_certificate: {
                        required : 'Please Upload Registration Certificate',
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
