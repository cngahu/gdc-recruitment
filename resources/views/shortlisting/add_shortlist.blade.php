@extends('panelist.panelist_dashboard')
@section('panelist')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Add Shortlist </div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page"> Creation </li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">

            </div>
        </div>
        <!--end breadcrumb-->
        <div class="card border-top border-left  border-0 border-4 border-success">
            <div class="card-body p-5">
                <div class="card-title d-flex align-items-center">
                    <div><i class="bx bxs-user me-1 font-22 text-info"></i>
                    </div>
                    <h5 class="mb-0 "style="font-size:large">Add Shortlist</h5>
                </div>
                <hr>
                <form class="row g-3" id="myForm" method="post" action="{{route('store.shortlist')}}"  >
                    @csrf
<input type="hidden"  name="vacancyid" value="{{$vacancyid}}">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="inputLastName2" class="form-label" style="font-size:large">Stage Name</label>
                            <div class="form-group">
                                <input type="number" name="Stage"  class="form-control border-start-0" id="inputLastName2" placeholder="Enter Name" />
                                @error('Stage')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <div class="col-md-6">
                            <label for="inputLastName2" class="form-label" style="font-size:large">Criteria</label>
                            <div class="form-group">
                                <input type="text" name="Criteria"  class="form-control border-start-0" id="inputLastName2" placeholder="Enter Name" />
                                @error('Criteria')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>

                    </div>
                    <p></p>



                    <div class="col-12">
                        <button type="submit" style="width: 100%" class="btn btn-success " style="font-size:large">Submit</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection


