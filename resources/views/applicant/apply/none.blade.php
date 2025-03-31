@extends('applicant.applicant_dashboard')
@section('applicant')

    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <div class="row justify-content-center">
                <div class="col-lg-6 col-xl-4 mb-4">
                    <div class="error-text-box">
                        <svg viewBox="0 0 600 200">
                            <!-- Symbol-->
                            <symbol id="s-text">
                                <text text-anchor="middle" x="50%" y="50%" dy=".35em">Pending!</text>
                            </symbol>
                            <!-- Duplicate symbols-->
                            <use class="text" xlink:href="#s-text"></use>
                            <use class="text" xlink:href="#s-text"></use>
                            <use class="text" xlink:href="#s-text"></use>
                            <use class="text" xlink:href="#s-text"></use>
                            <use class="text" xlink:href="#s-text"></use>
                        </svg>
                    </div>
                    <div class="text-center">
                        <h3 class="mt-0 mb-2">Whoops! </h3>
                        <p class="text-muted mb-3">Dear {{$user->first_name}} It's looking like you are trying to apply for this position but your profile is not yet complete. Don't worry...

                            Here's a little tip that might help you get back on track.</p>

                        <a href="{{route('applicant.dashboard')}}" class="btn btn-success waves-effect waves-light">Click Here To Complete Your Profile First</a>
                    </div>
                    <!-- end row -->

                </div> <!-- end col -->
            </div>
            <!-- end row -->


        </div> <!-- container -->

    </div>
@endsection
