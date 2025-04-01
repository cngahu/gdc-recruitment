@php

    $user=\App\Models\User::where('id',\Illuminate\Support\Facades\Auth::user()->id)->first();

@endphp
<div class="left-side-menu">

    <div class="h-100" data-simplebar>

        <!-- User box -->

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul id="side-menu">

                <li class="menu-title">Dashboard</li>
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
<style>

        font-family: 'Poppins', sans-serif !important;
    }

    /* Basic layout and styling for the sidebar */
    .left-side-menu {
        background-color: #fff; /* Change to desired background color */
        min-height: 100vh;
        border-right: 1px solid #e1e1e1; /* Subtle border on the right */
        padding-top: 1rem; /* Space at the top (optional) */
    }

    .left-side-menu .menu-title {
        padding: 1rem;
        font-weight: 600;
        color: #555; /* Title text color */
        text-transform: uppercase; /* Optional: uppercase styling */
        letter-spacing: 0.5px; /* Optional: spacing for readability */
    }

    /* Top-level menu items */
    #side-menu {
        list-style: none;
        margin: 0;
        padding: 0;
    }

    #side-menu > li {
        position: relative;
    }

    #side-menu > li > a {
        display: block;
        padding: 0.75rem 1rem;
        color: #333; 
        text-decoration: none;
        transition: background-color 0.2s, color 0.2s;
    }

    #side-menu > li > a:hover,
    #side-menu > li > a:focus {
        background-color: #f5f5f5; /* Hover color */
        color: #000; /* Hover text color */
        text-decoration: none; 
    }

    /* Icons spacing */
    #side-menu > li > a .mdi {
        margin-right: 8px;
    }

    /* Badge styling */
    .badge.bg-pink {
        background-color: #e91e63 !important; /* Material pink */
    }

    /* Sub-menu items */
    .nav-second-level {
        list-style: none;
        margin: 0;
        padding: 0 0 0 1rem; /* Indent sub-menu items */
    }

    .nav-second-level li a {
        display: block;
        padding: 0.5rem 1rem;
        color: #666;
        text-decoration: none;
        transition: background-color 0.2s, color 0.2s;
    }

    .nav-second-level li a:hover,
    .nav-second-level li a:focus {
        background-color: #f5f5f5;
        color: #000;
        text-decoration: none;
    }

    /* Optional styling for collapse arrow icons */
    .menu-arrow {
        float: right;
        transition: transform 0.3s;
    }

    /* Example rotation for arrow on open (if you toggle a class in JS) */
    .menu-arrow.open {
        transform: rotate(90deg);
    }

    /* Improve spacing for the badge or other float-end items */
    .float-end {
        float: right !important;
        margin-left: auto;
    }
</style>
