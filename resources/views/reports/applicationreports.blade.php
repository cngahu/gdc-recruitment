@extends('admin_dashboard')
@section('admin')
    <div class="content">

        <div class="container-fluid">



            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title">Report Details</h5>
                </div>
                <div class="card-body">
                    <iframe
                        src="{{ route('vacancy.applications.pdf') }}"
                        style="width: 100%; height: 600px; border: none;">
                    </iframe>
                </div>



        </div> <!-- container -->

    </div> <!-- content -->



@endsection
