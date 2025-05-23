@extends('admin_dashboard')
@section('admin')
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">

                        <h4 class="page-title">Stage 1:Applicants For Position :{{$vacancy->jobTitle}}</h4>
                    </div>
                    <a href="{{route('stage1.report',$vacancy->id)}}" class="btn btn-primary">Report</a>
                    <a href="{{route('stage1.close',$vacancy->id)}}" class="btn btn-success">Close Stage</a>
                    <a href="{{route('stage1.reset',$vacancy->id)}}" class="btn btn-warning">Reset Stage</a>

                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">Filter Parameters</h4>
                            <form class="row " id="myForm" method="post" action="{{route('stage1.filter')}}"  >
                                @csrf
                                <input type="hidden" name="vacancyid" value="{{$vacancy->id}}">

                                <div class="col-md-3">
                                    <h4 class="header-title">Academic Level</h4>

                                    <select name="academiclevel"  id="academic" required="" class="form-control">
                                        <option value="" selected="" disabled="">Select </option>
                                        @foreach($academiclevel as $item)
                                            <option value="{{$item->id }}">{{$item->name}}</option>
                                        @endforeach
                                    </select>


                                    <div class="form-check">
                                        <input type="checkbox" value="1" name="exclude" class="form-check-input" id="customCheck1"  >
                                        <label class="form-check-label" style="color: red" for="customCheck1">Exclude Higher Qualifications</label>
                                    </div>

                                </div>


                                <div class="col-md-3">
                                    <h4 class="header-title">Course Category</h4>


                                    @foreach($courecategories as $item)
                                        <input type="checkbox" class="form-check-input" name="coursecategory[]" id="customCheck1" value="{{$item->id}}">
                                        <label class="form-check-label" for="customCheck1">{{$item->name}}</label><br>
                                    @endforeach



                                </div>
                                <div class="col-md-3">
                                    <h4 class="header-title">Professional Qualifications</h4>

                                    <select name="professional" id="professional" class="form-control">
                                        <option value="" selected="" disabled="">Select Status</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>

                                    </select>


                                </div>
                                <div class="col-md-3">
                                    <h4 class="header-title">Professional Membership</h4>

                                    <select name="membership" id="membership"  class="form-control">
                                        <option value="" selected="" disabled="">Select Status</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>

                                    </select>

                                </div>
                                <div class="col-md-3">
                                    <h4 class="header-title">Minimum Years of Experience</h4>

                                    <input type="number" name="experience" >


                                </div>
                                <div class="col-md-3">
                                    <h4 class="header-title">Minimum/Maximum Age</h4>

                                    <input type="number" name="minage" style="width: 45%">
                                    &nbsp;|&nbsp;



                                    <input type="number" name="maxage" style="width: 45%">

                                </div>
                                <div class="col-md-4">
                                    <div></div>


                                    <div class="form-check">
                                        <input type="checkbox" value="1" name="disability" class="form-check-input"   >
                                        <label class="form-check-label" style="color: red" for="customCheck1">Include Persons With Disability</label>
                                    </div>

                                </div>


                                <div class="row">
                                    <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i class="mdi mdi-content-save"></i> Apply Filter</button>
                                </div>
                            </form>


                        </div>
                        <div class="card-body">


                            <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
                                <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Names</th>
                                    <th>ID No</th>
                                    <th>County</th>
                                    <th>Gender</th>
                                    <th>Disability</th>
                                    <th>Highest Academic</th>

                                    <th>Profile</th>

                                </tr>
                                </thead>


                                <tbody>

                                @php
                                    \App\Models\TempInSelection::where('vacancyid',$vacancy->id)->delete();


                             @endphp
                                @foreach($res as $key=> $item)

                                    @php
                                        \App\Models\TempInSelection::insert([
                                            'jobapplicationid'=>$item->ja,
                                               'vacancyid'=>$vacancy->id,
                                            ]);

                                    @endphp

                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $item->first_name}} {{ $item->other_name}} {{ $item->last_name}}</td>
                                        <td>{{ $item->idnumber }}</td>
                                        <td>{{ $item->county}}</td>
                                        <td>{{ $item->gender }}</td>

                                        <td>{{ $item->disability }}</td>
                                        <td>{{ $item->hal}}</td>
                                        <td><a href="{{route('jobapplicant.profile',[$item->id,$item->ja])}}" >Profile</a></td>


                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        </div> <!-- end card body-->
                        <div class="card-body">
                            <form class="row " id="myForm" method="post" action="{{route('stage1filter.submit')}}"  >
                                @csrf
                                <input type="hidden" name="vacancyid" value="{{$vacancy->id}}">
                                <input type="hidden" name="queryid" value="{{$queryid}}">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="firstname" class="form-label">Summary of Criteria selected</label>
                                            <input type="text" name="comments" class="form-control" required   >

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <button type="submit" class="btn btn-danger waves-effect waves-light mt-2"><i class="mdi mdi-content-save"></i> Proceed With This Candidates</button>

                                        </div>

                                    </div>
                                </div>



                            </form>

                        </div>


                    </div> <!-- end card -->
                </div><!-- end col-->
            </div>
            <!-- end row-->




        </div> <!-- container -->

    </div> <!-- content -->


@endsection
