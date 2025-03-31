
@extends('applicant.applicant_dashboard')
@section('applicant')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

  <div class="row">
      <h5 style="color:seagreen">Step 1 of 7</h5>
      <h3>Personal Details</h3>
      <div class="page-content">
          @if ($errors->any())
              <div class="alert alert-danger">
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
          @endif

          <div class="card border-top border-left  border-0 border-4 border-success">
              <div class="card-body ">

                  <form class="row " id="myForm" method="post" action="{{route('applicant.store')}}" enctype="multipart/form-data" >
                      @csrf
                      <input hidden="" name="userid" value="{{$user->id}}">


                      <div class="row">
                          <div class="col-md-3">
                              <label for="inputLastName2" class="form-label"  >Email Address</label>
                              <div class="form-group">
                                  <input type="text" name="email" style="background-color: grey;color: whitesmoke"  value="{{$user->email}}"  class="form-control border-start-0" />
                              </div>
                          </div>
                          <div class="col-md-3">
                              <label for="inputLastName2" class="form-label" >First Name  <span style="color: red;">*</span></label>
                              <div class="form-group">
                                  <input type="text"  name="first_name" value="{{$user->first_name}}"  class="form-control border-start-0" />
                              </div>
                          </div>

                          <div class="col-md-3">
                              <label for="inputLastName2" class="form-label" > Other Name  <span style="color: red;">*</span></label>
                              <div class="form-group">
                                  <input type="text"   name="other_name" value="{{$user->other_name}}"  class="form-control border-start-0" />
                              </div>
                          </div>
                          <div class="col-md-3">
                              <label for="inputLastName2" class="form-label" > Surname  <span style="color: red;">*</span></label>
                              <div class="form-group">
                                  <input type="text"  name="last_name" value="{{$user->last_name}}"  class="form-control border-start-0" />
                              </div>
                          </div>
                          <br>


                      </div>
                      <p></p>
                      <div class="row">
                          <div class="col-md-4">
                              <label for="inputLastName2" class="form-label" style="font-size:large" >Title(Mr/Mrs/Ms ):  <span style="color: red;">*</span></label>
                              <div class="form-group">
                                  <select name="title"  id="title" required="" class="form-control">
                                      <option value="" selected="" disabled="">Select </option>
                                      @foreach($designation as $item)
                                          <option value="{{$item->id }}">{{$item->name}}</option>
                                      @endforeach
                                  </select>
                              </div>
                          </div>
                          <div class="col-md-4">
                              <label for="inputLastName2" class="form-label" style="font-size:large">Date Of Birth  <span style="color: red;">*</span></label>
                              <div class="form-group">
                                  <input type="date" id="date_picker" name="dob" value="" class="form-control"   />

                              </div>
                          </div>
                          <br>
                          <div class="col-md-4">
                              <label for="inputLastName2" class="form-label" style="font-size:large" >National ID/Passport Number:  <span style="color: red;">*</span></label>
                              <div class="form-group">
                                  <input type="text" id="idnumber" name="idnumber" value="{{$user->idnumber}}" class="form-control border-start-0" placeholder="ID/Passport Number"/>
                              </div>
                          </div>

                      </div>
                      <p></p>

                        <p></p>
                      <div class="row">
                          <div class="col-md-4">
                              <label for="inputLastName2" class="form-label" style="font-size:large">Gender  <span style="color: red;">*</span></label>
                              <div class="form-group">
                                  <select name="gender"  id="gender" required="" class="form-control">
                                      <option value="" selected="" disabled="">Select </option>
                                      @foreach($gender as $item)
                                          <option value="{{ $item->id }}">{{ $item->name }}</option>
                                      @endforeach
                                  </select>
                              </div>
                          </div>
                          <div class="col-md-4">
                              <label for="inputLastName2" class="form-label" style="font-size:large">Ethnicity  <span style="color: red;">*</span></label>
                              <div class="form-group">
                                  <select name="ethnicity"  id="ethnicity" required="" class="form-control">
                                      <option value="" selected="" disabled="">Select </option>
                                      @foreach($ethnicity as $item)
                                          <option value="{{ $item->id }}">{{ $item->name }}</option>
                                      @endforeach
                                  </select>
                              </div>
                          </div>
                          <div class="col-md-4">
                              <label for="inputLastName2" class="form-label" style="font-size:large">County Of Birth  <span style="color: red;">*</span></label>
                              <div class="form-group">
                                  <select name="county"  id="county" required="" class="form-control">
                                      <option value="" selected="" disabled="">Select </option>
                                      @foreach($county as $item)
                                          <option value="{{ $item->id }}">{{ $item->name }}</option>
                                      @endforeach
                                  </select>
                              </div>
                          </div>
                          <br>


                      </div>
                    <p></p>
                      <div class="row">
                          <div class="col-md-4">
                              <label for="inputLastName2" class="form-label" style="font-size:large">Constituency  <span style="color: red;">*</span></label>
                              <div class="form-group">
                                  <select name="constituency_id" class="form-select" id="inputCollection">
                                      <option></option>

                                  </select>
                              </div>
                          </div>
                          <div class="col-md-4">
                              <label for="postal_address" class="form-label" style="font-size:large">Postal Address  <span style="color: red;">*</span></label>
                              <div class="form-group">
                                  <input type="number" name="postal_address"  id="postal_address" class="form-control border-start-0"  placeholder="Postal Address" />
                              </div>
                          </div>
{{--                          <div class="col-md-4">--}}
{{--                              <label for="postal_code" class="form-label"style="font-size:large">Postal Code</label>--}}
{{--                              <div class="form-group">--}}
{{--                                  <input type="number" name="postal_code" id="postal_code" class="form-control border-start-0"  placeholder="Postal code" />--}}
{{--                              </div>--}}
{{--                          </div>--}}


                          <div class="col-md-4">
                              <label for="city" class="form-label"style="font-size:large">City/Town  <span style="color: red;">*</span></label>
                              <div class="form-group">
                                  <input type="text" name="city" id="city"  class="form-control border-start-0" placeholder="City/Town" />
                              </div>
                          </div>

                      </div>
                      <p></p>
                      <div class="row">
{{--                          <div class="col-md-4">--}}
{{--                              <label for="postal_code" class="form-label"style="font-size:large">Phone Number  <span style="color: red;">*</span></label>--}}
{{--                              <div class="form-group">--}}
{{--                                  <input type="number" name="phone"   class="form-control border-start-0" id="phone" placeholder="Phone Number" />--}}
{{--                              </div>--}}
{{--                          </div>--}}
                          <div class="col-md-4">
                              <label for="phone" class="form-label" style="font-size:large">Phone Number <span style="color: red;">*</span></label>
                              <div class="form-group">
                                  <input type="number"
                                         name="phone"
                                         class="form-control border-start-0"
                                         id="phone"
                                         placeholder="0700123456"
                                         pattern="^0[0-9]{9}$"
                                         title="Phone number must be 10 digits starting with 0"
                                         required />
                                  <x-input-error :messages="$errors->get('phone')" style="color: red" class="mt-2" />

                              </div>
                          </div>

                          {{--                          <div class="col-md-4">--}}
{{--                              <label for="postal_address" class="form-label" style="font-size:large">Marital Status</label>--}}
{{--                              <div class="form-group">--}}
{{--                                  <select name="marital"  id="marital" required="" class="form-control">--}}
{{--                                      <option value="" selected="" disabled="">Select </option>--}}
{{--                                      @foreach($marital as $item)--}}
{{--                                          <option value="{{ $item->id }}">{{ $item->name }}</option>--}}
{{--                                      @endforeach--}}

{{--                                  </select>--}}
{{--                              </div>--}}
{{--                          </div>--}}

                          <div class="col-md-4">
                              <label for="city" class="form-label"style="font-size:large">Do you Have Any Disability?  <span style="color: red;">*</span></label>
                              <div class="form-group">
                                  <select name="disability" id="disability" required="" class="form-control">
                                      <option value="" selected="" disabled="">Select Status</option>
                                      <option value="Yes">Yes</option>
                                      <option value="No">No</option>

                                  </select>
                              </div>
                          </div>
                          <div class="col-md-4"  id="group2" style="display: none">
                              <label for="disability_desc" class="form-label"style="font-size:large">Are you registered with The National Council for Persons with Disabilities (NCPWD) ?  <span style="color: red;">*</span></label>
                              <div class="form-group">
                                  <select name="disability_reg" id="disability_reg" required="" class="form-control">
                                      <option value="" selected="" disabled="">Select Status</option>
                                      <option value=1>Yes</option>
                                      <option value=0>No</option>

                                  </select>
                              </div>
                          </div>
                      </div>







                      <p></p>


                      <div class="row" id="group1" style="display: none">

                          <div class="col-md-6">
                              <label for="inputLastName2" class="form-label" style="font-size:large" >Disability Registration Number  <span style="color: red;">*</span></label>
                              <div class="form-group">
                                  <input name="disabilitydescription" class="form-control" type="text" id="disabilitydescription" placeholder="Disability Registration Number" >

                              </div>
                          </div>
                          <div class="col-md-6">
                              <div class="mb-3 form-group">
                                  <label for="reg_certificate" class="form-label">Upload Registration Certificate in PDF Format.Ensure document is less than 2mbs  <span style="color: red;">*</span></label>
                                  <input type="file" name="reg_certificate" id="reg_certificate" class="form-control"  accept="application/pdf">

                              </div>
                          </div>


                      </div>
                      <div class="row" id="group3" style="display: none">

                          <div class="col-md-6">
                              <label for="inputLastName2" class="form-label" style="font-size:large" >Describe your disability  <span style="color: red;">*</span></label>
                              <div class="form-group">
                                  <input name="disabilitydesc" class="form-control" type="text" id="disabilitydesc" placeholder="Disability Description" >

                              </div>
                          </div>



                      </div>
                      <p></p>

{{--                      <div class="col-12" >--}}
{{--                          <button type="submit" style="width: 100%" class="btn btn-success " style="font-size:large">Submit</button>--}}
{{--                      </div>--}}

                      <div class="col-12" id="buttonsdiv">
                          <button type="submit" style="width: 100%" class="btn btn-success " style="font-size:large">Submit</button>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </div>

{{--    <script language="javascript">--}}
{{--        var today = new Date();--}}
{{--        var dd = String(today.getDate()).padStart(2, '0');--}}
{{--        var mm = String(today.getMonth() + 1).padStart(2, '0');--}}
{{--        var yyyy = today.getFullYear();--}}
{{--        maxDate: (new Date()).toString()--}}
{{--        today = yyyy + '-' + mm + '-' + dd;--}}
{{--        maxDate: "+1m +1w";--}}
{{--        $('#date_picker').attr('min',today);--}}
{{--    </script>--}}

    <script>
        $( "#date_picker" ).datepicker({
            maxDate: "+1m +1w"
        });
    </script>

    <script>
        $(function () {

            $('#disability').on('change', function() {

                if ( this.value == "Yes" )
                {
                    $("#group2").show();


                }
                else
                {
                    $("#group2").hide();
                    $("#group3").hide();
                    $("#group1").hide();


                    //
                    //
                    $("#disability_reg").val('');
                    $("#disabilitydescription").val('');
                    $("#reg_certificate").val('');
                    $("#disabilitydesc").val('');


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
                    first_name: {
                        required : true,
                    },

                    last_name: {
                        required : true,
                    },
                    title: {
                        required : true,
                    },
                    dob: {
                        required : true,
                    },
                    idnumber: {
                        required : true,
                    },
                    // kra: {
                    //     required : true,
                    // },
                    gender: {
                        required : true,
                    },
                    // nationality: {
                    //     required : true,
                    // },
                    ethnicity: {
                        required : true,
                    },
                    county: {
                        required : true,
                    },
                    // constituency: {
                    //     required : true,
                    // },

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
                    constituency_id: {
                        required : true,
                    },




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
                    constituency_id : {
                        required : 'Constituency Name is Required',
                    },
                    first_name: {
                        required : 'First Name is Required',
                    },
                    title: {
                        required : 'Please Select The Title',
                    },
                    last_name: {
                        required : 'Last Name is Required',
                    },
                    dob: {
                        required : 'Please Select Date of Birth',
                    },
                    idnumber: {
                        required : 'Please EnterNational ID/ Passport Number',
                    },
                    // kra: {
                    //     required : 'Please Enter KRA PIN Number',
                    // },
                    gender: {
                        required : 'Please Select Appropriate Gender',
                    },
                    // nationality: {
                    //     required : 'Please Select Nationality',
                    // },
                    ethnicity: {
                        required : 'Please Select Ethnicity',
                    },
                    county: {
                        required : 'Please Select Home County',
                    },
                    // constituency: {
                    //     required : 'Please Select Constituency',
                    // },
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

                    // marital: {
                    //     required : 'Please Select Marital Status',
                    // },
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
