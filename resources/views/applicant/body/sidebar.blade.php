@php

    $user=\App\Models\User::where('id',\Illuminate\Support\Facades\Auth::user()->id)->first();

@endphp
<div class="left-side-menu">

    <div class="h-100" data-simplebar>

        <!-- User box -->

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul id="side-menu">

                <li class="menu-title">Navigation</li>
                <li>
                    <a href="{{route('applicant.dashboard')}}">
                        <i class="mdi mdi-view-dashboard-outline"></i>
                        <span> Dashboard </span>
                    </a>
                </li>
                @if($user->level < 7)
                <li>
                    <a href="{{route('dashboard.openvacancies')}}">
                        <i class="mdi mdi-view-dashboard-outline"></i>
                        <span> Available Vacancies  </span>

                        </a>
                </li>
                @endif
                @if($user->level==2)

                    <li>
                        <a href="#orders" data-bs-toggle="collapse">
                            <i class="mdi mdi-email-multiple-outline"></i>
                            <span class="badge bg-pink float-end"> Sections</span>
                            <span>Applicant Profile </span>
                        </a>
                        <div>
                            <ul class="nav-second-level">
                                <li>
                                    <a href="{{route('applicant.profile',$user->id)}}">Personal Details </a>
                                    <a href="{{route('applicant.profile.disability',$user->id)}}">Disability Details </a>
                                </li>




                            </ul>
                        </div>
                    </li>
                    @elseif($user->level==3)

                        <li>
                            <a href="#orders" data-bs-toggle="collapse">
                                <i class="mdi mdi-email-multiple-outline"></i>
                                <span class="badge bg-pink float-end"> Sections</span>
                                <span>Applicant Profile </span>
                            </a>
                            <div>
                                <ul class="nav-second-level">
                                    <li>
                                        <a href="{{route('applicant.profile',$user->id)}}">Personal Details </a>
                                        <a href="{{route('applicant.profile.disability',$user->id)}}">Disability Details </a>

                                    </li>
                                    <li>
                                        <a href="{{route('applicant.alleducation')}}">Education Profile </a>
                                    </li>




                                </ul>
                            </div>
                        </li>
                @elseif($user->level==4)

                    <li>
                        <a href="#orders" data-bs-toggle="collapse">
                            <i class="mdi mdi-email-multiple-outline"></i>
                            <span class="badge bg-pink float-end"> Sections</span>
                            <span>Applicant Profile </span>
                        </a>
                        <div>
                            <ul class="nav-second-level">
                                <li>
                                    <a href="{{route('applicant.profile',$user->id)}}">Personal Details </a>
                                    <a href="{{route('applicant.profile.disability',$user->id)}}">Disability Details </a>

                                </li>
                                <li>
                                    <a href="{{route('applicant.alleducation')}}">Education Profile </a>
                                </li>
                                <li>
                                    <a href="{{route('applicant.proffessionalqual')}}">Professional Qualifications</a>
                                </li>




                            </ul>
                        </div>
                    </li>
                @elseif($user->level==5)

                    <li>
                        <a href="#orders" data-bs-toggle="collapse">
                            <i class="mdi mdi-email-multiple-outline"></i>
                            <span class="badge bg-pink float-end"> Sections</span>
                            <span>Applicant Profile </span>
                        </a>
                        <div>
                            <ul class="nav-second-level">
                                <li>
                                    <a href="{{route('applicant.profile',$user->id)}}">Personal Details </a>
                                    <a href="{{route('applicant.profile.disability',$user->id)}}">Disability Details </a>

                                </li>
                                <li>
                                    <a href="{{route('applicant.alleducation')}}">Education Profile </a>
                                </li>
                                <li>
                                    <a href="{{route('applicant.proffessionalqual')}}">Professional Qualifications</a>
                                </li>
                                <li>
                                    <a href="{{route('applicant.proffmembership')}}">Professional Memberships</a>
                                </li>




                            </ul>
                        </div>
                    </li>
                @elseif($user->level==6)

                    <li>
                        <a href="#orders" data-bs-toggle="collapse">
                            <i class="mdi mdi-email-multiple-outline"></i>
                            <span class="badge bg-pink float-end"> Sections</span>
                            <span>Applicant Profile </span>
                        </a>
                        <div>
                            <ul class="nav-second-level">
                                <li>
                                    <a href="{{route('applicant.profile',$user->id)}}">Personal Details </a>
                                    <a href="{{route('applicant.profile.disability',$user->id)}}">Disability Details </a>

                                </li>
                                <li>
                                    <a href="{{route('applicant.alleducation')}}">Education Profile </a>
                                </li>
                                <li>
                                    <a href="{{route('applicant.proffessionalqual')}}">Professional Qualifications</a>
                                </li>
                                <li>
                                    <a href="{{route('applicant.proffmembership')}}">Professional Memberships</a>
                                </li>
                                <li>
                                    <a href="{{route('applicant.experience')}}">Experience</a>
                                </li>




                            </ul>
                        </div>
                    </li>
                @elseif($user->level==7)

                    <li>
                        <a href="#orders" data-bs-toggle="collapse">
                            <i class="mdi mdi-email-multiple-outline"></i>
                            <span class="badge bg-pink float-end"> Sections</span>
                            <span>Applicant Profile </span>
                        </a>
                        <div>
                            <ul class="nav-second-level">
                                <li>
                                    <a href="{{route('applicant.profile',$user->id)}}">Personal Details </a>
                                    <a href="{{route('applicant.profile.disability',$user->id)}}">Disability Details </a>

                                </li>
                                <li>
                                    <a href="{{route('applicant.alleducation')}}">Education Profile </a>
                                </li>
                                <li>
                                    <a href="{{route('applicant.proffessionalqual')}}">Professional Qualifications</a>
                                </li>
                                <li>
                                    <a href="{{route('applicant.proffmembership')}}">Professional Memberships</a>
                                </li>
                                <li>
                                    <a href="{{route('applicant.experience')}}">Experience</a>
                                </li>
                                <li>
                                    <a href="{{route('applicant.leadership')}}">Leadership</a>
                                </li>



                            </ul>
                        </div>
                    </li>
                @elseif($user->level==8)

                <li>
                    <a href="{{route('applicant.completeprofile')}}">
                        <span class="badge bg-pink float-end">Completed</span>
                        <i class="mdi mdi-view-dashboard-outline"></i>
                        <span>My Profile </span>
                    </a>
                </li>
                    <li>
                        <a href="#orders" data-bs-toggle="collapse">
                            <i class="mdi mdi-email-multiple-outline"></i>
                            <span class="badge bg-pink float-end"> Sections</span>
                            <span>Edit  Profile </span>
                        </a>
                        <div>
                            <ul class="nav-second-level">
                                <li>
                                    <a href="{{route('applicant.profile',$user->id)}}">Personal Details </a>
                                    <a href="{{route('applicant.profile.disability',$user->id)}}">Disability Details </a>

                                </li>
                                <li>
                                    <a href="{{route('applicant.alleducation')}}">Education Profile </a>
                                </li>
                                <li>
                                    <a href="{{route('applicant.proffessionalqual')}}">Professional Qualifications</a>
                                </li>
                                <li>
                                    <a href="{{route('applicant.proffmembership')}}">Professional Memberships</a>
                                </li>
                                <li>
                                    <a href="{{route('applicant.experience')}}">Experience</a>
                                </li>
                                <li>
                                    <a href="{{route('applicant.leadership')}}">Leadership</a>
                                </li>
                                <li>
                                    <a href="{{route('applicant.applicantdoc')}}">Application Documents</a>
                                </li>




                            </ul>
                        </div>
                    </li>
                    <li>
                        <a href="#orders" data-bs-toggle="collapse">
                            <i class="mdi mdi-email-multiple-outline"></i>
                            <span> Recruitments  </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="orders">
                            <ul class="nav-second-level">
                                <li>
                                    <a href="{{route('all.openvacancies')}}">Active Recruitments </a>
                                </li>

                                <li>
                                    <a href="{{route('all.applicationsmade')}}">Application History </a>

                                </li>


                            </ul>
                        </div>
                    </li>
                @endif






            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
