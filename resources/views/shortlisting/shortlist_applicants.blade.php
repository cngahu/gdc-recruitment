@extends('panelist.panelist_dashboard')
@section('panelist')
 <div class="contents">
     <div class="container-fluid">
         <div class="row">
             <div class="col-12">
                 <div class="ps-3">
                     <nav aria-label="breadcrumb">
                         <ol class="breadcrumb mb-0 p-0">
                             <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                             </li>
                             <li class="breadcrumb-item active" aria-current="page">{{$myvacancy->JobTitle}}</li>
                             <li class="breadcrumb-item active" aria-current="page">Total:  {{$totalcount}} , Reviewed: --, Balance:--</li>

                         </ol>
                     </nav>
                 </div>
             </div>
         </div>

         <div class="row">
         <div class="card">
             <div class="card-body">
                 <div class="table-responsive">
                     <table id="basic-datatable" class="table table-striped table-bordered" style="width:100%">
                         <thead>
                         <tr>
                             <th>SL</th>
                             <th>Names</th>
                             <th>ID No</th>
                             <th>County</th>
                             <th>Gender</th>
                             <th>Disability</th>
                             <th>Ethnicity</th>

                             <th >Age</th>
                             <th >Profile</th>
                         </tr>
                         </thead>
                         <tbody>
                         @php
                             $sno = 0;
                         @endphp
                         @foreach( $applicants as $key => $item )
                             <tr>
                                 <td>{{$key +1}}</td>
                                 <td>{{ $item['user']['first_name']}} {{ $item['user']['other_name']}} {{ $item['user']['last_name']}}</td>
                                 <td>{{ $item['user']['idnumber'] }}</td>
                                 <td>{{ $item['user']['ccounty']['name']}}</td>
                                 <td>{{ $item['user']['cgender']['name'] }}</td>

                                 <td>{{ $item['user']['disability'] }}</td>
                                 <td>  {{ $item['user']['ethnicity1']['name'] }}</td>

                                 <td>{{$item['user']['age']}}</td>
                                 <td>
                                     {{--                                    <button class='btn btn-info viewdetails' data-id='{{ $user->id }}' >View Details</button>--}}
                                     <a href="{{route('shortlist.profile', [$item->userid,$stage->id])}}"   class="btn btn-success">Profile</a>

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
                             <th>Disability</th>
                             {{--                            <th>Academic Level</th>--}}
                             {{--                            <th >Highest Course</th>--}}
                             <th >Age</th>
                             <th >Profile</th>



                         </tr>
                         </tfoot>
                     </table>
                 </div>
             </div>
         </div>
         </div>

     </div>
 </div>


@endsection



