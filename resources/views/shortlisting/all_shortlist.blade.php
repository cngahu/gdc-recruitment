@extends('panelist.panelist_dashboard')
@section('panelist')

    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">All Shortlists</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">All Shortlists</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{route('create.shortlist')}}" style="float:right;" class="btn btn-round btn-success mb-5">Add Criteria</a>

                </div>
            </div>
        </div>
        <!--end breadcrumb-->

        <hr/>

        <div class="card">
            <div class="card-body">

                <h4 class="header-title">Shortlisting Report for Vacancy : {{$myvacancy->jobTitle}}</h4>
                <p class="text-muted font-13 mb-4">
                    <a href="{{route('final.shortlist', $myvacancy->id)}}"  class="btn btn-warning">The Shortlist Report Report</a>

                </p>
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                        <tr>
                            <th>SL</th>
                            <th>Stage</th>
                            <th>Criteria</th>
                            <th>Status</th>

                            <th>Actions</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach( $shortlists as $key => $item )
                            <tr>
                                <td>{{$key +1}}</td>
                                <td>{{$item->stage}}</td>
                                <td>{{$item->criteria}}</td>
                                <td>{{$item->status}}</td>

                                <td>

                                    @php
                                      $ccount=  \App\Models\ShortlistingLogger::where('stage',$item->id)->count();

                                        @endphp
                                    @if($ccount==0)
                                    <a href="{{route('start.shortlist', $item->id)}}"  class="btn btn-info">Start Shortlisting</a>
                                    @elseif($ccount>0 && $item->status==1)
                                        <a href="{{route('start.shortlist', $item->id)}}"  class="btn btn-success">Continue Shortlisting</a>
                                        <a href="{{route('provisional.shortlist', $item->id)}}"  class="btn btn-warning">Provisional Report</a>
{{--                                        <a href="{{route('final.shortlist', $item->id)}}"  class="btn btn-warning">Final Report</a>--}}

                                    @elseif($ccount>0 && $item->status==0)
                                        <a href="{{route('provisional.shortlist', $item->id)}}"  class="btn btn-warning"> Report</a>

                                    @endif

                                </td>

                            </tr>
                        @endforeach
                        </tbody>

                        <tfoot>
                        <tr>
                            <th>SL</th>
                            <th>Stage</th>
                            <th>Criteria</th>
                            <th>Status</th>
                            <th>Actions</th>



                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>



    </div>
@endsection



