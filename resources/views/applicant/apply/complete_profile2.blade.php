
@extends('applicant.applicant_dashboard')
@section('applicant')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <div class="page-content">

        <div class="card border-top border-left  border-0 border-4 border-success">
            <div class="card-body ">

                <div class="container">
                    <header>
                        <h3>{{$user->first_name}} {{$user->other_name}} {{$user->last_name}}</h3>
                        <p>Job Applicant</p>
                    </header>

                    <section class="profile-info">
                        <h3 style="background-color: blue; color: white; text-align: center">Profile Information</h3>
                        <form class="row " id="myForm"  method="post"  >



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
                                        <select name="title" disabled id="title" required="" class="form-control">
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
                                        <input type="date" id="date_picker" disabled name="dob" value="{{$user->dob}}" class="form-control"   />

                                    </div>
                                </div>
                                <br>
                                <div class="col-md-4">
                                    <label for="inputLastName2" class="form-label"  >National ID/Passport Number:</label>
                                    <div class="form-group">
                                        <input type="text" id="idnumber" disabled name="idnumber" value="{{$user->idnumber}}" class="form-control border-start-0" placeholder="ID/Passport Number"/>
                                    </div>
                                </div>

                            </div>
                            <p></p>
                            <div class="row">




                            </div>
                            <p></p>
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="inputLastName2" class="form-label">Gender</label>
                                    <div class="form-group">
                                        <select name="gender" disabled id="gender" required="" class="form-control">
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
                                        <select name="ethnicity" disabled id="ethnicity" required="" class="form-control">
                                            <option value="" selected="" disabled="">Select </option>
                                            @foreach($ethnicity as $item)
                                                <option value="{{ $item->id }}" {{$user->ethnicity==$item->id ? 'selected':'' }}>{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="inputLastName2" class="form-label" >Home County</label>
                                    <div class="form-group">
                                        <select name="county"  disabled id="county" required="" class="form-control">
                                            <option value="" selected=""  disabled="">Select </option>
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
                                        <input type="text" name="postal_address"  disabled  id="postal_address" value="{{$user->postal_address}}" class="form-control border-start-0"  placeholder="Postal Address" />
                                    </div>
                                </div>
{{--                                <div class="col-md-4">--}}
{{--                                    <label for="postal_code" class="form-label">Postal Code</label>--}}
{{--                                    <div class="form-group">--}}
{{--                                        <input type="number" name="postal_code" disabled  id="city" value="{{$user->postal_code}}" class="form-control border-start-0"  placeholder="Postal code" />--}}
{{--                                    </div>--}}
{{--                                </div>--}}


                                <div class="col-md-4">
                                    <label for="city" class="form-label">City/Town</label>
                                    <div class="form-group">
                                        <input type="text" name="city" id="city"  disabled  value="{{$user->city}}" class="form-control border-start-0" placeholder="City/Town" />
                                    </div>
                                </div>

                            </div>
                            <p></p>
                            <div class="row">

                                <div class="col-md-4">
                                    <label for="postal_code" class="form-label">Phone Number</label>
                                    <div class="form-group">
                                        <input type="number" name="phone" disabled  value="{{$user->phone}}"  class="form-control border-start-0" id="phone" placeholder="Phone Number" />
                                    </div>
                                </div>
{{--                                <div class="col-md-4">--}}
{{--                                    <label for="postal_address" class="form-label" >Marital Status</label>--}}
{{--                                    <div class="form-group">--}}
{{--                                        <select name="marital"  disabled  id="marital" required="" class="form-control">--}}
{{--                                            <option value="" selected="" disabled="">Select </option>--}}
{{--                                            @foreach($marital as $item)--}}
{{--                                                <option value="{{ $item->id }}" {{$user->marital==$item->id ? 'selected':'' }}>{{ $item->name }}</option>--}}
{{--                                            @endforeach--}}

{{--                                        </select>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

                                <div class="col-md-4">
                                    <label for="city" class="form-label" >Do you Have Any Disability?</label>
                                    <div class="form-group">
                                        <select name="disability"  disabled id="disability" required="" class="form-control">
                                            <option value="" selected="" disabled="">Select Status</option>
                                            <option value="Yes" {{$user->disability=="Yes" ? 'selected':'' }}>Yes</option>
                                            <option value="No" {{$user->disability=="No" ? 'selected':'' }}>No</option>

                                        </select>
                                    </div>
                                </div>

                            </div>

                            <p></p>

{{--                            <div class="row" id="group1" style="display: none">--}}
{{--                                <div class="col-md-6">--}}
{{--                                    <label for="inputLastName2" class="form-label"  >Disability Description</label>--}}
{{--                                    <div class="form-group">--}}
{{--                                        <input name="disabilitydescription" value="{{$user->disabilitydescription}}" class="form-control" type="text" id="disabilitydescription" placeholder="Disability Description" >--}}

{{--                                    </div>--}}
{{--                                </div>--}}


{{--                            </div>--}}
                            <p></p>

                            @if($user->disability=="Yes")
                                <div class="col-md-4"  >
                                    <label for="disability_desc" class="form-label">Are you registered with The National Council for Persons with Disabilities (NCPWD) ?</label>
                                    <div class="form-group">
                                        <select    required="" class="form-control">
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

                        <div class="col-md-4">
                            <label for="inputLastName2" class="form-label" >Disability Registration Number</label>
                            <div class="form-group">
                                <input      class="form-control" type="text"  placeholder="Disability Registration Number"  value="{{$user->disabilitydescription}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3 form-group">
                                {{--                                  <label for="reg_certificate" class="form-label">Uploaded Registration Certificate </label>--}}
                                {{--                                  <input type="file" name="reg_certificate" id="reg_certificate" class="form-control"  accept="application/pdf">--}}
                                <a href="{{asset($user->disability_cert)}}" class="btn btn-primary" target="_blank">Click To View Uploaded Registration Certificate</a>
                            </div>
                        </div>


                    </div>
                @elseif($user->disability=="Yes" && $user->disability_reg==0)
                    <div class="row" id="group3" >

                        <div class="col-md-4">
                            <label for="inputLastName2" class="form-label"  >Describe your disability</label>
                            <div class="form-group">
                                <input       value="{{$user->disability_desc}}" class="form-control" type="text"  placeholder="Disability Description" >

                            </div>
                        </div>



                    </div>
                    @endif


                        </form>

                    </section>

                    <section class="education">
                        <div class="table-responsive pt-3">
                            <table class="table table-centered table-nowrap table-borderless mb-0">
                                <h3 style="background-color: purple; color: white; text-align: center">Educational Background</h3>

                                <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Institution</th>
                                    <th>Level</th>
                                    <th>Course</th>
                                    <th>Exit Date</th>
                                    <th>Grade</th>
                                    {{--                                    <th>Certificate No</th>--}}
                                    <th>Certificate</th>
{{--                                    <th>Actions</th>--}}
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($edu_profile as $key=> $item)
                                    <tr class=".table-striped">
                                        <td> {{ $key+1 }} </td>
                                        <td>{{$item->institutionName}}</td>
                                        <td>{{$item['assign_academiclevel']['name']}}</td>
                                        <td>{{$item->courseName}}</td>
                                        <td>{{$item->exitDate}}</td>
                                        <td>{{$item['assign_grade']['name']}}</td>
                                        {{--                                    <td>{{$item->certNo}}</td>--}}
                                        <td><a href="{{asset($item->certificate)}}" target="_blank" >Certificate</a> </td>

{{--                                        <td>--}}
{{--                                            <a href="{{route('education.edit',$item->id)}}" class="btn btn-primary"><i class="material-symbols-outlined">edit</i></a>--}}
{{--                                            <a href="{{route('education.delete',$item->id)}}" class="btn btn-danger"  id="delete" ><i class="material-symbols-outlined">delete</i></a>--}}

{{--                                        </td>--}}


                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>

                    </section>

                    <section class="professional-background">
                        <h3 style="background-color: darkred; color: white; text-align: center">Professional Background</h3>
                        <div id="cardCollpase4" class="collapse show">
                            <div class="table-responsive pt-3">
                                <table class="table table-centered table-nowrap table-borderless mb-0">
                                    <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Institution</th>
                                        <th>Course</th>

                                        <th>Completion Date</th>
                                        <th>Grade</th>
                                        <th>Certificate</th>
{{--                                        <th>Actions</th>--}}
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($proff_qual as $key=> $item)
                                        <tr class=".table-striped">
                                            <td> {{ $key+1 }} </td>
                                            <td>{{$item->institutionName}}</td>
                                            <td>{{$item->courseName}}</td>

                                            <td>{{$item->exitDate}}</td>
                                            <td>{{$item->grade}}</td>
                                            <td><a href="{{asset($item->certificate)}}" target="_blank" >Certificate</a> </td>

{{--                                            <td>--}}
{{--                                                <a href="{{route('proffessionalqual.edit',$item->id)}}" class="btn btn-primary"><i class="material-symbols-outlined">edit</i></a>--}}
{{--                                                <a href="{{route('proffessionalqual.delete',$item->id)}}" class="btn btn-danger"  id="delete" ><i class="material-symbols-outlined">delete</i></a>--}}

{{--                                            </td>--}}


                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div> <!-- .table-responsive -->
                        </div> <!-- end collapse-->

                    </section>

                    <section class="professional-body">
                        <div class="table-responsive pt-3">
                            <h3 style="background-color: darkgoldenrod; color: white; text-align: center">Professional Body Membership</h3>

                            <table class="table table-centered table-nowrap table-borderless mb-0">
                                <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Professional Body</th>
                                    <th>Membership Number</th>
                                    <th>Status</th>
                                    <th>Certificate</th>

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

{{--                                        <td>--}}
{{--                                            <a href="{{route('proffmembership.edit',$item->id)}}" class="btn btn-primary"><i class="material-symbols-outlined">edit</i></a>--}}
{{--                                            <a href="{{route('proffmembership.delete',$item->id)}}" class="btn btn-danger"  id="delete" ><i class="material-symbols-outlined">delete</i></a>--}}

{{--                                        </td>--}}


                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div> <!-- .table-responsive -->

                    </section>
                    <section class="professional-body">
                        <div class="table-responsive pt-3">
                            <h3 style="background-color: darkgoldenrod; color: white; text-align: center">Work Experience</h3>
                            <div class="table-responsive pt-3">
                                <table class="table table-centered table-nowrap table-borderless mb-0">
                                    <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Company</th>
                                        <th>Job Title</th>
                                        <th>Duties</th>
                                        <th>Start Date</th>
                                        <th>Exit Reasons</th>

{{--                                        <th>Actions</th>--}}
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($experience as $key=> $item)
                                        <tr class=".table-striped">
                                            <td> {{ $key+1 }} </td>
                                            <td>{{$item->company}}</td>
                                            <td>{{$item->jobTitle}}</td>
                                            <td>{!! $item->Duties !!} }</td>
                                            <td>{{$item->startDate}}</td>
                                            <td>{{$item->exitReasons}}</td>

{{--                                            <td>--}}
{{--                                                <a href="{{route('education.edit',$item->id)}}" class="btn btn-primary"><i class="material-symbols-outlined">edit</i></a>--}}
{{--                                                <a href="{{route('education.delete',$item->id)}}" class="btn btn-danger"  id="delete" ><i class="material-symbols-outlined">delete</i></a>--}}

{{--                                            </td>--}}


                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div> <!-- .table-responsive -->

                        </div> <!-- .table-responsive -->

                    </section>

                    <section class="attachments">
                        <h3 style="background-color: darkgreen; color: white; text-align: center" >Attachments</h3>

                        <table  class="table dt-responsive nowrap w-100">
                            <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Document Name</th>
                                <th>Link</th>
{{--                                <th>Action</th>--}}
                            </tr>
                            </thead>


                            <tbody>
                            @foreach($jobdocs as $key=> $item)
                                <tr>
                                    <td>{{ $key+1 }}</td>

                                    <td>{{ $item['document']['document_name']}}</td>
                                    <td>
                                        <a href="  {{asset($item->path)}}" target="_blank">Link</a>

                                    </td>

{{--                                    <td>--}}
{{--                                        <a href="{{ route('applicantdoc.edit',$item->id) }}" class="btn btn-blue rounded-pill waves-effect waves-light">Edit</a>--}}
{{--                                        <a href="{{ route('applicantdoc.delete',$item->id) }}" class="btn btn-danger rounded-pill waves-effect waves-light" id="delete">Delete</a>--}}
{{--                                    </td>--}}
                                </tr>
                            @endforeach
                            </tbody>
                        </table>



                    </section>
                </div>

            </div>
        </div>
    </div>

@endsection
