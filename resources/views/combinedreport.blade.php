@extends('admin_dashboard')
@section('admin')
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">

                        <h4 class="page-title">Applicants For Position :{{$myvacancy->jobTitle}}</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">


{{--                                <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">--}}
{{----}}
                            <table id="example" class="table table-striped dt-responsive nowrap w-100">

                            <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Name and Contacts</th>
                                    <th>Academic and Professional Qualifications</th>
                                    <th>Work Experience</th>


                                </tr>
                                </thead>


                                <tbody>
                                @foreach($applicants as $key=> $item)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>
                                            <strong>                                            {{ $item['user']['first_name']}} {{ $item['user']['other_name']}} {{ $item['user']['last_name']}}
                                            </strong><br>
                                        Email: {{$item['user']['email']}} <br>
                                            Tel: {{$item['user']['phone']}} <br>
{{--                                            @if($item['user']['county'] != null)--}}
{{--                                            County: {{$item['user']['ccounty']['name']}} <br>--}}
{{--                                            @else--}}
{{--                                                County: <br>--}}
{{--                                            @endif--}}

{{--                                            @if($item['user']['ethnicity'] != null)--}}
{{--                                                Ethnicity: {{$item['user']['ethnicity1']['name']}} <br>--}}
{{--                                            @else--}}
{{--                                                Ethnicity: <br>--}}
{{--                                            @endif--}}

                                            @if($item['user']['gender'] != null)
                                                Sex: {{$item['user']['cgender']['name']}} <br>
                                            @else
                                                Sex: <br>
                                            @endif

                                            DOB: {{\Carbon\Carbon::parse($item['user']['dob'])->format('d/m/Y')}} <br>
                                            Disability: {{$item['user']['disability']}} <br>
                                        </td>
                                        @php
                                        $academics=\App\Models\EducationQualifications::with('assign_academiclevel')->where('userid',$item->userid)->get();
                                       $professional=\App\Models\ProffessionalQual::where('userid',$item->userid)->get();
                                        $membership=\App\Models\ProffessionalMembership::where('userid',$item->userid)->get();
                                        $experience=\App\Models\Experience::where('userid',$item->userid)->get();

                                        @endphp
                                        <td>
                                            <h4 style="color: #FF9600">MEMBERSHIP BODIES</h4>                                            @foreach($academics as $key=> $item)
                                                <strong>{{$item->courseName}}</strong> ({{$item['assign_academiclevel']['name']}}) <br>
                                                Exit Date:{{\Carbon\Carbon::parse($item->exitDate)->format('d/m/Y')}} at {{$item->institutionName}}<br>
                                            @endforeach


                                            @if($professional != null)
                                                <h4 style="color: #FF9600">MEMBERSHIP BODIES</h4>                                                @foreach($professional as $key=> $item)
                                                    <strong>{{$item->courseName}}</strong> ({{$item->institutionName}}) <br>
                                                    Exit Date:{{\Carbon\Carbon::parse($item->exitDate)->format('d/m/Y')}} <br>
                                                @endforeach
                                                @else
                                                NO PROFESSIONAL QUALIFICATIONS

                                                @endif


                                                 @if($membership != null)
                                                <h4 style="color: #FF9600">MEMBERSHIP BODIES</h4>

                                                    @foreach($membership as $key=> $item)
                                                    <strong>{{$item->proffBody}}</strong> (Number:{{$item->memberNumber}}) <br>
                                                    Status: @if($item->active==0)Not Active @else Active @endif
                                                    <br>
                                                @endforeach
                                                @else
                                                    NO MEMBERSHIP TO PROFESSIONAL BODY

                                                @endif

                                        </td>
                                        <td>
                                            @if($experience != null)

                                                @foreach($experience as $key=> $item)
                                                    <strong>{{\Carbon\Carbon::parse($item->startDate)->format('d/m/Y')}}</strong>--<strong>{{\Carbon\Carbon::parse($item->exitDate)->format('d/m/Y')}}</strong>{{$item->jobTitle}} / {{$item->company}} <br>

                                                    <br>
                                                @endforeach
                                            @else
                                                NO WORK EXPERIENCE
                                            @endif
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
