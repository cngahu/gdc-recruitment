@extends('applicant.applicant_dashboard')
@section('applicant')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <h4 class="page-title">Application for Job Title: {{$vacancy->jobTitle}}</h4>
            <!-- start page title -->
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

                    <div class="row">
                        <form method="post" id="myForm" action="{{ route('jobsapply.save') }}" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="vacancyid" value="{{$vacancy->id}}">
                            @foreach($uploaddocs as $key=> $item)
                                <div class="col-md-6">
                                    <div class="mb-3 form-group">
                                        <label for="certificate" class="form-label">Upload {{$item['document']['document_name']}} in PDF Format. Ensure document is less than 2mbs</label>
                                        <input type="file" name="fileid[{{$item->document_id}}]" id="fileid{{$item->document_id}}" class="form-control file-input" accept="application/pdf">
                                        <span class="text-danger error-message" style="display:none;">This field is required</span>
                                    </div>
                                </div> <!-- end col -->
                            @endforeach

                            <div class="col-12" id="buttonsdiv">
                                <button type="submit" id="btnSubmit" class="btn btn-success"><i class="mdi mdi-content-save"></i>Apply For Position</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div> <!-- container -->
    </div> <!-- content -->

    <script>
        $(document).ready(function() {
            $('#btnSubmit').on('click', function(event) {
                var isValid = true;
                $('.file-input').each(function() {
                    if ($(this).val() === '') {
                        isValid = false;
                        $(this).siblings('.error-message').show();
                    } else {
                        $(this).siblings('.error-message').hide();
                    }
                });
                if (!isValid) {
                    event.preventDefault();
                }
            });
        });
    </script>

@endsection
