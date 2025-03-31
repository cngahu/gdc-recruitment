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
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Add Panel User</a></li>

                            </ol>
                        </div>
                        <h4 class="page-title">Add User</h4>
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
                                <form method="post" action="{{ route('panel.update') }}" >
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $panel->id }}">
                                    <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> Update Panel User</h5>

                                    <div class="row">


                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="first_name" class="form-label">First Name</label>
                                                <input type="text" name="first_name" value="{{ $panel->first_name }}" class="form-control @error('first_name') is-invalid @enderror"   >
                                                @error('first_name')
                                                <span class="text-danger"> {{ $message }} </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="other_name" class="form-label">Other Name</label>
                                                <input type="text" name="other_name" value="{{ $panel->other_name }}" class="form-control @error('other_name') is-invalid @enderror"   >
                                                @error('other_name')
                                                <span class="text-danger"> {{ $message }} </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="last_name" class="form-label">Last Name</label>
                                                <input type="text" name="last_name" value="{{ $panel->last_name }}" class="form-control @error('last_name') is-invalid @enderror"   >
                                                @error('last_name')
                                                <span class="text-danger"> {{ $message }} </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="text" name="email" value="{{ $panel->email }}" class="form-control @error('email') is-invalid @enderror"   >
                                                @error('email')
                                                <span class="text-danger"> {{ $message }} </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="idnumber" class="form-label">Employment No/Id Number</label>
                                                <input type="text" name="idnumber" value="{{ $panel->idnumber }}" class="form-control @error('idnumber') is-invalid @enderror"   >
                                                @error('idnumber')
                                                <span class="text-danger"> {{ $message }} </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="panel_role" class="form-label">Panel Role</label>

                                                <select name="panel_role" class="form-control @error('panel_role') is-invalid @enderror">
                                                    <option value="" disabled>Select</option>
                                                    <option value="Chair" {{ old('panel_role', $panel->panel_role) === 'Chair' ? 'selected' : '' }}>Chair</option>
                                                    <option value="Member" {{ old('panel_role', $panel->panel_role) === 'Member' ? 'selected' : '' }}>Member</option>
                                                    <option value="Secretary" {{ old('panel_role', $panel->panel_role) === 'Secretary' ? 'selected' : '' }}>Secretary</option>
                                                </select>

                                                @error('panel_role')
                                                <span class="text-danger"> {{ $message }} </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="vacancy_id" class="form-label"  >Vacancy Name</label>

                                                    <select name="vacancy_id" id="vacancy_id" required="" class="form-control @error('vacancy_id') is-invalid @enderror">
                                                        <option value="" disabled>Select</option>
                                                        @foreach($vacancy as $item)
                                                            <option value="{{ $item->id }}" {{ old('vacancy_id', $panel->vacancy_id) == $item->id ? 'selected' : '' }}>
                                                                {{ $item->jobTitle }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                @error('panel_role')
                                                <span class="text-danger"> {{ $message }} </span>
                                                @enderror

                                            </div>
                                        </div>



                                        <div class="text-end">
                                            <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i class="mdi mdi-content-save"></i> Save</button>
                                        </div>
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
                    first_name: {
                        required : true,
                    },
                    last_name: {
                        required : true,
                    },
                    email: {
                        required : true,
                    },
                    idnumber: {
                        required : true,
                    },





                },
                messages :{
                    first_name: {
                        required : 'First Name Required',
                    },
                    last_name: {
                        required : 'Last Name Required',
                    },
                    email: {
                        required : 'Email Required',
                    },
                    idnumber: {
                        required : 'Id Number/ Emp Number is required',


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
            $('#image').change(function(e){
                var reader = new FileReader();
                reader.onload =  function(e){
                    $('#showImage').attr('src',e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });

    </script>







@endsection
