
@extends('applicant.applicant_dashboard')
@section('applicant')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

  <div class="row">

      <h3>Personal Details</h3>
      <div class="page-content">

          <div class="card border-top border-left  border-0 border-4 border-success">
              <div class="card-body ">

                  <form class="row " id="myForm"  method="post"   action="{{ route('profile.update') }}" enctype="multipart/form-data">
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
                      <p></p>
                      <div class="row">
                          <div class="col-md-4">
                              <label for="inputLastName2" class="form-label"  >Title(Mr/Mrs/Ms ):</label>
                              <div class="form-group">
                                  <select name="title"  id="title" required="" class="form-control">
                                      <option value="" selected="" disabled="">Select </option>
                                      @foreach($designation as $item)
                                          <option value="{{$item->id }}" {{$user->title==$item->id ? 'selected':'' }}>{{$item->name}}</option>
                                      @endforeach
                                  </select>
                              </div>
                          </div>
                          <div class="col-md-4">
                              <label for="inputLastName2" class="form-label" >Date Of Birth</label>
                              <div class="form-group">
                                  <input type="date" id="date_picker" name="dob" value="{{$user->dob}}" class="form-control"   />

                              </div>
                          </div>
                          <br>
                          <div class="col-md-4">
                              <label for="inputLastName2" class="form-label"  >National ID/Passport Number:</label>
                              <div class="form-group">
                                  <input type="text" id="idnumber" name="idnumber" value="{{$user->idnumber}}" class="form-control border-start-0" placeholder="ID/Passport Number"/>
                              </div>
                          </div>

                      </div>
                      <p></p>
                      <div class="row">
{{--                          <div class="col-md-4">--}}
{{--                              <label for="inputLastName2" class="form-label"  >KRA PIN</label>--}}
{{--                              <div class="form-group">--}}
{{--                                  <input type="text"  minlength="11" maxlength="11" id="kra" value="{{$user->kra}}" name="kra"  class="form-control"   />--}}

{{--                              </div>--}}
{{--                          </div>--}}



                      </div>
                        <p></p>
                      <div class="row">
                          <div class="col-md-4">
                              <label for="inputLastName2" class="form-label">Sex</label>
                              <div class="form-group">
                                  <select name="gender"  id="gender" required="" class="form-control">
                                      <option value="" selected="" disabled="">Select </option>
                                      @foreach($gender as $item)
                                          <option value="{{ $item->id }}" {{$user->gender==$item->id ? 'selected':'' }}>{{ $item->name }}</option>
                                      @endforeach
                                  </select>
                              </div>
                          </div>
                          <div class="col-md-4">
                              <label for="inputLastName2" class="form-label" >Ethnicity</label>
                              <div class="form-group">
                                  <select name="ethnicity"  id="ethnicity" required="" class="form-control">
                                      <option value="" selected="" disabled="">Select </option>
                                      @foreach($ethnicity as $item)
                                          <option value="{{ $item->id }}" {{$user->ethnicity==$item->id ? 'selected':'' }}>{{ $item->name }}</option>
                                      @endforeach
                                  </select>
                              </div>
                          </div>
                          <div class="col-md-4">
                              <label for="inputLastName2" class="form-label" > County Of Birth</label>
                              <div class="form-group">
                                  <select name="county"  id="county" required="" class="form-control">
                                      <option value="" selected="" disabled="">Select </option>
                                      @foreach($county as $item)
                                          <option value="{{ $item->id }}" {{$user->county==$item->id ? 'selected':'' }}>{{ $item->name }}</option>
                                      @endforeach
                                  </select>
                              </div>
                          </div>
                          <br>


                      </div>
                    <p></p>
                      <div class="row">
                          <div class="col-md-4">
                              <label for="inputLastName2" class="form-label" > Constituency</label>
                              <div class="form-group">
                                  <select name="constituency_id"  id="constituency_id" required="" class="form-control">
                                      <option value="" selected="" disabled="">Select </option>
                                      @foreach($constituency as $item)
                                          <option value="{{ $item->id }}" {{$user->constituency==$item->id ? 'selected':'' }}>{{ $item->name }}</option>
                                      @endforeach
                                  </select>
                              </div>
                          </div>
                          <div class="col-md-4">
                              <label for="postal_address" class="form-label" >Postal Address</label>
                              <div class="form-group">
                                  <input type="text" name="postal_address"  id="postal_address" value="{{$user->postal_address}}" class="form-control border-start-0"  placeholder="Postal Address" />
                              </div>
                          </div>
{{--                          <div class="col-md-4">--}}
{{--                              <label for="postal_code" class="form-label">Postal Code</label>--}}
{{--                              <div class="form-group">--}}
{{--                                  <input type="number" name="postal_code" id="city" value="{{$user->postal_code}}" class="form-control border-start-0"  placeholder="Postal code" />--}}
{{--                              </div>--}}
{{--                          </div>--}}


                          <div class="col-md-4">
                              <label for="city" class="form-label">City/Town</label>
                              <div class="form-group">
                                  <input type="text" name="city" id="city"  value="{{$user->city}}" class="form-control border-start-0" placeholder="City/Town" />
                              </div>
                          </div>

                      </div>
                      <p></p>
                      <div class="row">
                          <div class="col-md-4">
                              <label for="postal_code" class="form-label">Phone Number</label>
                              <div class="form-group">
                                  <input type="number" name="phone" value="{{$user->phone}}"  class="form-control border-start-0" id="phone" placeholder="Phone Number" />
                              </div>
                          </div>
{{--                          <div class="col-md-4">--}}
{{--                              <label for="postal_address" class="form-label" >Marital Status</label>--}}
{{--                              <div class="form-group">--}}
{{--                                  <select name="marital"  id="marital" required="" class="form-control">--}}
{{--                                      <option value="" selected="" disabled="">Select </option>--}}
{{--                                      @foreach($marital as $item)--}}
{{--                                          <option value="{{ $item->id }}" {{$user->marital==$item->id ? 'selected':'' }}>{{ $item->name }}</option>--}}
{{--                                      @endforeach--}}

{{--                                  </select>--}}
{{--                              </div>--}}
{{--                          </div>--}}

                          <div class="col-md-4">
                              <label for="city" class="form-label" >Do you Have Any Disability?</label>
                              <div class="form-group">
                                  <select disabled style="background-color: grey;color: whitesmoke" required="" class="form-control">
                                      <option value="" selected="" disabled="">Select Status</option>
                                      <option value="Yes" {{$user->disability=="Yes" ? 'selected':'' }}>Yes</option>
                                      <option value="No" {{$user->disability=="No" ? 'selected':'' }}>No</option>

                                  </select>
                              </div>
                          </div>

                          @if($user->disability=="Yes")
                          <div class="col-md-4"  id="group2" >
                              <label for="disability_desc" class="form-label">Are you registered with The National Council for Persons with Disabilities (NCPWD) ?</label>
                              <div class="form-group">
                                  <select disabled style="background-color: grey;color: whitesmoke" required="" class="form-control">
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
                      <div class="row" id="group1" >

                          <div class="col-md-6">
                              <label for="inputLastName2" class="form-label" style="font-size:large" >Disability Registration Number</label>
                              <div class="form-group">
                                  <input disabled style="background-color: grey;color: whitesmoke" name="disabilitydescription" class="form-control" type="text" id="disabilitydescription" placeholder="Disability Registration Number"  value="{{$user->disabilitydescription}}">
                              </div>
                          </div>
                          <div class="col-md-6">
                              <div class="mb-3 form-group">
{{--                                  <label for="reg_certificate" class="form-label">Uploaded Registration Certificate in PDF Format.Ensure document is less than 2mbs</label>--}}
{{--                                  <input type="file" name="reg_certificate" id="reg_certificate" class="form-control"  accept="application/pdf">--}}
                                    <a href="{{asset($user->disability_cert)}}" class="btn btn-primary" target="_blank">Uploaded Registration Certificate</a>
                              </div>
                          </div>


                      </div>
                      @elseif($user->disability=="Yes" && $user->disability_reg==0)
                      <div class="row" id="group3" >

                          <div class="col-md-6">
                              <label for="inputLastName2" class="form-label" style="font-size:large" >Describe your disability</label>
                              <div class="form-group">
                                  <input disabled style="background-color: grey;color: whitesmoke" name="disabilitydesc" value="{{$user->disability_desc}}" class="form-control" type="text" id="disabilitydesc" placeholder="Disability Description" >

                              </div>
                          </div>



                      </div>

{{--                      <div class="row" id="group1" style="display: none">--}}
{{--                          <div class="col-md-6">--}}
{{--                              <label for="inputLastName2" class="form-label"  >Disability Description</label>--}}
{{--                              <div class="form-group">--}}
{{--                                  <input name="disabilitydescription" value="{{$user->disabilitydescription}}" class="form-control" type="text" id="disabilitydescription" placeholder="Disability Description" >--}}

{{--                              </div>--}}
{{--                          </div>--}}


{{--                      </div>--}}
                      @endif
                      <p></p>

                      <div class="col-12" >
                          <button type="submit" style="width: 50%" class="btn btn-success form-group" style="font-size:large">Update</button>
                          <a href="{{route('applicant.alleducation')}}" class="btn btn-warning">Proceed To Next Stage</a>

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
                    $("#group1").show();


                }
                else
                {
                    $("#group1").hide();

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
                    title: {
                        required : true,
                    },
                    dob: {
                        required : true,
                    },
                    idnumber: {
                        required : true,
                    },
                    kra: {
                        required : true,
                    },
                    gender: {
                        required : true,
                    },
                    nationality: {
                        required : true,
                    },
                    ethnicity: {
                        required : true,
                    },
                    county: {
                        required : true,
                    },
                    constituency: {
                        required : true,
                    },

                    postal_address: {
                        required : true,
                    },
                    postal_code: {
                        required : true,
                    },
                    city: {
                        required : true,
                    },
                    phone: {
                        required : true,
                    },

                    marital: {
                        required : true,
                    },
                    // disability: {
                    //     required : true,
                    // },
                    //
                    //
                    // disabilitydescription: {
                    //     required : function(element){
                    //         return Number(($('#disability').val()=="Yes"));
                    //     },
                    // },


                },
                messages :{
                    title: {
                        required : 'Please Select The Title',
                    },
                    dob: {
                        required : 'Please Select Date of Birth',
                    },
                    idnumber: {
                        required : 'Please EnterNational ID/ Passport Number',
                    },
                    kra: {
                        required : 'Please Enter KRA PIN Number',
                    },
                    gender: {
                        required : 'Please Select Appropriate Gender',
                    },
                    nationality: {
                        required : 'Please Select Nationality',
                    },
                    ethnicity: {
                        required : 'Please Select Ethnicity',
                    },
                    county: {
                        required : 'Please Select Home County',
                    },
                    constituency: {
                        required : 'Please Select Constituency',
                    },
                    postal_address: {
                        required : 'Please Enter Postal Address',
                    },
                    postal_code: {
                        required : 'Please Enter the Postal Code',
                    },
                    city: {
                        required : 'Please Enter The City',
                    },
                    phone: {
                        required : 'Please Enter Phone Number',
                    },

                    marital: {
                        required : 'Please Select Marital Status',
                    },
                    // disability: {
                    //     required : 'Please Select Disability',
                    // },
                    //
                    // disabilitydescription: {
                    //     required : 'Please Enter Disability Description',
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
    <script type="text/javascript">

        $(document).ready(function(){
            $('select[name="county"]').on('change', function(){
                var county_id = $(this).val();
                if (county_id) {
                    $.ajax({
                        url: "{{ url('/constituencies/ajax') }}/"+county_id,
                        type: "GET",
                        dataType:"json",
                        success:function(data){
                            $('select[name="constituency_id"]').html('');
                            var d =$('select[name="constituency_id"]').empty();
                            $.each(data, function(key, value){
                                $('select[name="constituency_id"]').append('<option value="'+ value.id + '">' + value.name + '</option>');
                            });
                        },

                    });
                } else {
                    alert('danger');
                }
            });
        });

    </script>

@endsection
