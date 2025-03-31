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
                    <a href="{{route('admin.dashboard')}}">
                        <i class="mdi mdi-view-dashboard-outline"></i>
                        <span> Dashboard </span>
                    </a>
                </li>
{{--                <li>--}}
{{--                    <a href="#sidebarEcommerce" data-bs-toggle="collapse">--}}
{{--                        <i class="mdi mdi-cart-outline"></i>--}}
{{--                        <span> Roles and Permissions  </span>--}}
{{--                        <span class="menu-arrow"></span>--}}
{{--                    </a>--}}
{{--                    <div class="collapse" id="sidebarEcommerce">--}}
{{--                        <ul class="nav-second-level">--}}
{{--                            <li>--}}
{{--                                <a href="{{ route('all.permission') }}">All Permissions</a>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <a href="{{ route('add.designation') }}">Add Designation </a>--}}
{{--                            </li>--}}

{{--                        </ul>--}}
{{--                    </div>--}}
{{--                </li>--}}



                @if($user->adak_role==1)
                    <li class="menu-title mt-2">Constants</li>

                <li>
                    <a href="#sidebarEcommerce" data-bs-toggle="collapse">
                        <i class="mdi mdi-cart-outline"></i>
                        <span> Designations  </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarEcommerce">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('all.designation') }}">All Designations</a>
                            </li>
                            <li>
                                <a href="{{ route('add.designation') }}">Add Designation </a>
                            </li>

                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#sidebarCrm" data-bs-toggle="collapse">
                        <i class="mdi mdi-gender-male-female"></i>
                        <span>Sex </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarCrm">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('all.gender') }}">All Sex</a>
                            </li>
                            <li>
                                <a href="{{ route('add.gender') }}">Add Sex</a>
                            </li>

                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#sidebarCrm" data-bs-toggle="collapse">
                        <i class="mdi mdi-account-multiple-outline"></i>
                        <span>Constituency </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarCrm">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('all.constituency') }}">All Constituency</a>
                            </li>
                            <li>
                                <a href="{{ route('add.constituency') }}">Add Constituency</a>
                            </li>

                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#sidebarCrm" data-bs-toggle="collapse">
                        <i class="mdi mdi-account"></i>
                        <span>County </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarCrm">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('all.county') }}">All County</a>
                            </li>
                            <li>
                                <a href="{{ route('add.county') }}">Add County</a>
                            </li>

                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#sidebarCrm" data-bs-toggle="collapse">
                        <i class="mdi-view-dashboard"></i>
                        <span>Countries</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarCrm">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('all.nation') }}">All Country</a>
                            </li>
                            <li>
                                <a href="{{ route('add.nation') }}">Add Country</a>
                            </li>

                        </ul>
                    </div>
                </li>
                <li>
                        <a href="#sidebarCrm" data-bs-toggle="collapse">
                            <i class="mdi-view-dashboard"></i>
                            <span>Ethnicities</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="sidebarCrm">
                            <ul class="nav-second-level">
                                <li>
                                    <a href="{{ route('all.ethnicity') }}">All Ethnicities</a>
                                </li>
                                <li>
                                    <a href="{{ route('add.ethnicity') }}">Add Ethnicity</a>
                                </li>

                            </ul>
                        </div>
                    </li>
                <li class="menu-title mt-2">Custom</li>


{{--                <li>--}}
{{--                    <a href="#sidebarExpages" data-bs-toggle="collapse">--}}
{{--                        <i class="mdi mdi-text-box-multiple-outline"></i>--}}
{{--                        <span> Extra Pages </span>--}}
{{--                        <span class="menu-arrow"></span>--}}
{{--                    </a>--}}
{{--                    <div class="collapse" id="sidebarExpages">--}}
{{--                        <ul class="nav-second-level">--}}
{{--                            <li>--}}
{{--                                <a href="pages-starter.html">Starter</a>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <a href="pages-timeline.html">Timeline</a>--}}
{{--                            </li>--}}

{{--                        </ul>--}}
{{--                    </div>--}}
{{--                </li>--}}

                    <li class="menu-title mt-2">Constants</li>





                @elseif($user->adak_role==2)
                    <li>
                        <a href="{{route('builder.index')}}">
                            <i class="mdi mdi-shield-account-variant-outline"></i>
                            <span> Report Builder </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('builder.longlist.index')}}">
                            <i class="mdi mdi-apple-airplay"></i>
                            <span>Longlist Report Builder</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('admin.reports.index')}}">
                            <i class="mdi mdi-human"></i>
                            <span>Longlist Reports</span>
                        </a>
                    </li>
                    <li class="menu-title mt-2">Apps</li>



                    <li>
                        <a href="#sidebarEcommerce" data-bs-toggle="collapse">
                            <i class="mdi mdi-book-account-outline"></i>
                            <span> Applicants Manage  </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="sidebarEcommerce">
                            <ul class="nav-second-level">

                                <li>
                                    <a href="{{ route('all.unverified') }}">Unverified Emails</a>
                                </li>
{{--                                <li>--}}
{{--                                    <a href="{{ route('add_panelusers') }}">Add Panel Member </a>--}}
{{--                                </li>--}}

                            </ul>
                        </div>
                    </li>
                    <li>
                        <a href="#sidebarEcommerce" data-bs-toggle="collapse">
                            <i class="mdi mdi-cart-outline"></i>
                            <span> Panel Management  </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="sidebarEcommerce">
                            <ul class="nav-second-level">
{{--                                <li>--}}
{{--                                    <a href="{{ route('all.employee') }}">All Employee</a>--}}
{{--                                </li>--}}

                                <li>
                                    <a href="{{ route('all.panel.users') }}">All Panel</a>
                                </li>
                                <li>
                                    <a href="{{ route('add_panelusers') }}">Add Panel Member </a>
                                </li>

                            </ul>
                        </div>
                    </li>

                    <li>
                        <a href="#sidebarCrm" data-bs-toggle="collapse">
                            <i class="mdi mdi-account-multiple-outline"></i>
                            <span>  Reports </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="sidebarCrm">
                            <ul class="nav-second-level">
                                <li>
                                    <a href="{{route('vacancy.dashboard')}}">Vacancy Applications</a>
                                </li>
                                <li>
                                    <a href="{{route('vacancy.applications')}}"> Applications Report</a>
                                </li>
                                <li>
                                    <a href="{{url('/vacancies')}}">Applications By County</a>
                                </li>
                                <li>
                                    <a href="{{route('county.vacancies.report')}}">County Report</a>
                                </li>

                                <li>
                                    <a href="{{url('/ethnicities')}}">Applications By Ethnicity</a>
                                </li>

                            </ul>
                        </div>
                    </li>
                    <li>
                        <a href="#sidebarTickets" data-bs-toggle="collapse">
                            <i class="mdi mdi-lifebuoy"></i>
                            <span> Final Shortlists </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="sidebarTickets">
                            <ul class="nav-second-level">
                                <li>
                                    <a href="{{route('shortlist.final')}}">List</a>
                                </li>
                                <li>
                                    <a href="tickets-detail.html">Detail</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="menu-title mt-2">Recruitments</li>


                    <li>
                        <a href="#sidebarTasks" data-bs-toggle="collapse">
                            <i class="mdi mdi-clipboard-list"></i>
                            <span> Recruitment Manage  </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="sidebarTasks">
                            <ul class="nav-second-level">
                                <li>
                                    <a href="{{ route('all.recruitment') }}">All Recruitments</a>
                                </li>
                                <li>
                                    <a href="{{ route('add.recruitment') }}">Add Recruitment </a>
                                </li>
                                <li>
                                    <a href="{{ route('all.vacancies') }}">All Vacancies </a>
                                </li>

                            </ul>
                        </div>
                    </li>



                    <li class="menu-title mt-2">Current Vacancies</li>


                    <li>
                        <a href="#sidebarCrm" data-bs-toggle="collapse">
                            <i class="mdi mdi-spin mdi-star"></i>
                            <span> Open Vacancies  </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="sidebarCrm">
                            <ul class="nav-second-level">
                                <li>
                                    <a href="{{ route('all.jobs') }}">All Vacancies</a>
                                </li>
                                <li>
                                    <a href="{{ route('add.recruitment') }}">Add Recruitment </a>
                                </li>
                                <li>
                                    <a href="{{ route('all.vacancies') }}">All Vacancies </a>
                                </li>

                            </ul>
                        </div>
                    </li>
                    <li>
                        <a href="#sidebarEcommerce" data-bs-toggle="collapse">
                            <i class="mdi mdi-cart-outline"></i>
                            <span> Applicant Documents  </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="sidebarEcommerce">
                            <ul class="nav-second-level">
                                <li>
                                    <a href="{{ route('all.appdocs') }}">All Documents</a>
                                </li>
                                <li>
                                    <a href="{{ route('add.appdocs') }}">Add Documents </a>
                                </li>

                            </ul>
                        </div>
                    </li>

                @elseif($user->adak_role==2)
                    <li class="menu-title mt-2">Apps</li>
                @endif
            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
