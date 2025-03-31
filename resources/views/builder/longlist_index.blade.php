@extends('admin_dashboard')

@section('admin')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <div class="content">
        <div class="container-fluid">
            <!-- Start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Job Application Report Builder</h4>
                    </div>
                </div>
            </div>
            <!-- End page title -->

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

                                    <!-- Criteria Selection -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="criteria">Select Criteria</label>
                                            <select name="criteria" id="criteria" class="form-control">
                                                <option value="">Select Criteria</option>
                                                <option value="longlist">Application Long List</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-12 mt-3">
                                        <button type="submit" class="btn btn-primary">Generate Report</button>
                                    </div>
                                </div>
                            </form>
                            <!-- Loader -->
                            <div id="loader" style="display: none; text-align: center; margin-top: 20px;">
                                <p><strong>Just Chill while we run the drums in the backend!</strong></p>
                                <img src="https://i.gifer.com/VAyR.gif" alt="Loading..." style="width: 50px;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Report View -->
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
        </div>
    </div>

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

                // Show the loader and hide the iframe
                $("#loader").show();
                $("#report-iframe").hide();

                // Simulate loading for user experience and update iframe
                setTimeout(() => {
                    $("#loader").hide();
                    $("#report-iframe").show().attr("src", iframeUrl);
                }, 2000); // Adjust timeout as needed
            });
        });
    </script>
@endsection
