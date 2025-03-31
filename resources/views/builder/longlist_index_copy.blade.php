@extends('admin_dashboard')

@section('admin')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <div class="content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Job Application Report Builder</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <!-- Filters -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form id="report-form">
                                @csrf
                                <div class="row">
                                    <!-- Vacancy Selection -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="vacancy">Select Vacancy</label>
                                            <select name="vacancy_id" id="vacancy" class="form-control">
                                                <option value="">Select Vacancy</option>
                                                @foreach($vacancies as $vacancy)
                                                    <option value="{{ $vacancy->id }}">{{ $vacancy->jobTitle }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Criteria Selection (County or Ethnicity) -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="criteria">Select Criteria</label>
                                            <select name="criteria" id="criteria" class="form-control">
                                                <option value="">Select Criteria</option>
{{--                                                <option value="county">County</option>--}}
{{--                                                <option value="ethnicity">Ethnicity</option>--}}
{{--                                                <option value="date">Application Date</option>--}}
                                                <option value="longlist">Application Long List</option>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-12 mt-3">
                                        <button type="submit" class="btn btn-primary">Generate Report</button>
                                    </div>
                                </div>
                            </form>
                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->
            </div>
            <!-- end row -->

            <!-- Report View (iframe for displaying the report) -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5>Generated Report</h5>
                            <div id="report-view">
                                <iframe id="report-iframe" style="width: 100%; height: 600px; border: none;">
                                    Your browser does not support embedded PDFs.
                                </iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div> <!-- container -->
    </div> <!-- content -->

<script>

    {{--$(document).ready(function() {--}}
    {{--    $("#report-form").on("submit", function(e) {--}}
    {{--        e.preventDefault(); // Prevent default form submission--}}

    {{--        var vacancyId = $("#vacancy").val();  // Get the selected vacancy ID--}}
    {{--        var criteria = $("#criteria").val();  // Get the selected criteria--}}

    {{--        // Validate inputs--}}
    {{--        if (!vacancyId || !criteria) {--}}
    {{--            alert("Please select both Vacancy and Criteria.");--}}
    {{--            return;  // Stop if any of the fields are missing--}}
    {{--        }--}}

    {{--        // Send an AJAX request to generate the report--}}
    {{--        $.ajax({--}}
    {{--            url: "{{ route('generateReport') }}",--}}
    {{--            method: "POST",--}}
    {{--            data: {--}}
    {{--                _token: "{{ csrf_token() }}",--}}
    {{--                vacancy_id: vacancyId,--}}
    {{--                criteria: criteria--}}
    {{--            },--}}
    {{--            success: function(response) {--}}
    {{--                // Check if the response is a PDF and handle it as a Blob--}}
    {{--                var blob = new Blob([response], { type: "application/pdf" });--}}

    {{--                // Update iframe source with the created Blob URL--}}
    {{--                $("#report-iframe").attr("src", URL.createObjectURL(blob));--}}
    {{--            },--}}
    {{--            error: function() {--}}
    {{--                alert("There was an error generating the report.");--}}
    {{--            }--}}
    {{--        });--}}
    {{--    });--}}
    {{--});--}}

</script>
{{--    <script>--}}
{{--        $(document).ready(function() {--}}
{{--            $("#report-form").on("submit", function(e) {--}}
{{--                e.preventDefault();--}}

{{--                var vacancyId = $("#vacancy").val();--}}
{{--                var criteria = $("#criteria").val();--}}

{{--                if (!vacancyId || !criteria) {--}}
{{--                    alert("Please select both Vacancy and Criteria.");--}}
{{--                    return;--}}
{{--                }--}}

{{--                // Redirect to reload the iframe with updated URL--}}
{{--                const reportUrl = "{{ route('generateReportPdf') }}";--}}
{{--                const iframeUrl = `${reportUrl}?vacancy_id=${vacancyId}&criteria=${criteria}`;--}}

{{--                // Update the iframe source--}}
{{--                $("#report-iframe").attr("src", iframeUrl);--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}
<script>
    $(document).ready(function() {
        $("#report-form").on("submit", function(e) {
            e.preventDefault();

            var vacancyId = $("#vacancy").val();
            var criteria = $("#criteria").val();

            if (!vacancyId || !criteria) {
                alert("Please select both Vacancy and Criteria.");
                return;
            }

            const reportUrl = "{{ route('generateLonglistReportPdf') }}";
            const iframeUrl = `${reportUrl}?vacancy_id=${vacancyId}&criteria=${criteria}`;

            // Update the iframe source to show the new report
            $("#report-iframe").attr("src", iframeUrl);
        });
    });

</script>
@endsection
