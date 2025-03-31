@extends('applicant.applicant_dashboard')
@section('applicant')
<div class="content">

    <!-- Start Content-->
    <div class="container-fluid">
        <h4 class="page-title">Documents For Vacancy: {{$vacancyapplied['vacancy']['jobTitle']}} </h4>
        <!-- start page title -->
      <div class="card">
          <div class="card-body">
              <div class="row">
{{--                  <form method="post" id="myForm" action="{{ route('applicantdoc.store') }}" enctype="multipart/form-data">                                    @csrf--}}
{{--                      @csrf--}}
{{--                      <input type="hidden" name="userid" value="{{$userid}}">--}}
{{--                  @foreach($appdocs as $key=> $item)--}}


{{--                          <div class="col-md-6">--}}
{{--                              <div class="mb-3 form-group">--}}
{{--                                  <label for="certificate" class="form-label">Upload {{$item->document_name}} in PDF Format.Ensure document is less than 2mbs</label>--}}
{{--                                  <input type="file" name="fileid[{{$item->id}}]" required class="form-control"  accept="application/pdf">--}}
{{--                              </div>--}}
{{--                          </div> <!-- end col -->--}}



{{--                  @endforeach--}}
{{--                      <div class="text-end">--}}
{{--                          <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i class="mdi mdi-content-save"></i> Save</button>--}}
{{--                      </div>--}}
{{--                  </form>--}}

              </div>
          </div>
      </div>
        <!-- end page title -->


        <div class="row">

            <div class="col-12">
                <div class="card">
                    <div class="card-body">


                        <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                            <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Document Name</th>
                                <th>Link</th>
                                <th>Action</th>
                            </tr>
                            </thead>


                            <tbody>
                            @foreach($jobuploaddocs as $key=> $item)
                            <tr>
                                <td>{{ $key+1 }}</td>

                                <td>{{ $item['document']['document_name']}}</td>
                                <td>
                                    <a href="  {{asset($item->path)}}" target="_blank">Uploaded Document</a>

                                </td>

                                <td>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <form method="post" id="myForm" action="{{ route('jobsapply.editsave') }}" enctype="multipart/form-data">                                    @csrf

                                                <input type="hidden" name="docid" value="{{$item->id}}">

                                                <input type="hidden" name="userid" value="{{$item->userid}}">
                                                <input type="hidden" name="oldrecord=" value="{{$item->path}}">
                                                <input type="hidden" name="appid" value="{{$item->jobapplicationid}}">
                                                <input type="hidden" name="vacancyid" value="{{$item->vacancyid}}">




                                                <div class="mb-3 form-group">
                                                    <label for="certificate" class="form-label">Upload Different file</label>
                                                    <input type="file" name="newfile" required class="form-control"  accept="application/pdf">
                                                </div>







                                        </div>
                                        <div class="col-md-6">
                                            <div class="text-end">
                                                <button type="submit" id="btnSubmit" class="btn btn-success waves-effect waves-light mt-2"><i class="mdi mdi-content-save"></i>Save Changes</button>
                                            </div>

                                            </form>
                                        </div>

                                    </div>
{{--                                    <a href="{{ route('applicantdoc.edit',$item->id) }}" class="btn btn-blue rounded-pill waves-effect waves-light">Edit</a>--}}
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div>

        <!-- end row-->




    </div> <!-- container -->

</div> <!-- content -->


@endsection
