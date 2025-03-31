@extends('panelist.panelist_dashboard')
@section('panelist')
    <!-- CSS -->
{{--    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" >--}}

    <div class="content">
        <!--breadcrumb-->
       <div class="container-fluid">
           <div class="row">
               <div class="col-12">
                   <div class="page-title-box">

                       <h4 class="breadcrumb-item active" aria-current="page">{{$myvacancy->JobTitle}}</h4>

                   </div>
               </div>
           </div>
           <div class="row">
               <div class="card">
                   <div class="card-body">
                       <div class="table-responsive">
{{--                           datatable-buttons--}}
                           <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
                               <thead>
                               <tr>
                                   <th>SL</th>
                                   <th>Names</th>
                                   <th>ID No</th>
                                   <th>County</th>
                                   <th>Gender</th>
                                   <th>Email</th>
                                   <th>Phone</th>
                                   <th>Shortlisted</th>
                                   <th >Remarks</th>
                               </tr>
                               </thead>
                               <tbody>
                               @php
                                   $sno = 0;
                               @endphp
                               @foreach( $applicants as $key => $user )
                                   <tr>
                                       <td>{{$key +1}}</td>
                                       <td>{{$user->first_name}} &nbsp; &nbsp; {{$user->other_name}} &nbsp; &nbsp;{{$user->last_name}}</td>
                                       <td>{{$user->idnumber}}</td>
                                       <td>{{$user->county}}</td>
                                       <td>{{$user->gender}}</td>
                                       <td>{{$user->email}}</td>
                                       <td>{{$user->phone}}</td>

                                       @if($user->status=="Shortlisted")
                                           <td>Yes</td>
                                       @elseif($user->status=="dropped")
                                           <td>No</td>
                                       @elseif($user->status=="Applied")
                                           <td>Pending</td>
                                       @endif

                                       <td>
                                           @if($user->comments==null)
                                              Shortlisted
                                           @else
                                               {{$user->comments}}
                                           @endif

                                       </td>





                                   </tr>
                               @endforeach
                               </tbody>

                               <tfoot>
                               <tr>
                                   <th>SL</th>
                                   <th>Names</th>
                                   <th>ID No</th>
                                   <th>County</th>
                                   <th>Gender</th>
                                   <th>Email</th>
                                   <th>Phone</th>
                                   <th>Shortlisted</th>
                                   <th >Remarks</th>



                               </tr>
                               </tfoot>
                           </table>
                       </div>
                   </div>
               </div>
           </div>
       </div>
        <!--end breadcrumb-->

        <hr/>




    </div>

@endsection



