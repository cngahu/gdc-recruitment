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
                    <a href="{{route('panelist.dashboard')}}">
                        <i class="mdi mdi-view-dashboard-outline"></i>
                        <span> Dashboard </span>
                    </a>
                </li>
                @if($user->must_change==0)
                @if($user->adak_role==3)
                        <li>
                            <a href="{{route('load.applications')}}">
                                <i class="mdi mdi-view-comfy-outline"></i>
                                <span> Applicants </span>
                                 </a>
                        </li>

                        @if($user->panel_role=="Secretary")
                            <li>
                                <a href="#orders" data-bs-toggle="collapse">
                                    <i class="mdi mdi-email-multiple-outline"></i>
                                    <span> Shortlisting  </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="orders">
                                    <ul class="nav-second-level">


                                        <li>
                                            <a href="{{route('all.shortlist')}}">Shortlisting </a>

                                        </li>


                                    </ul>
                                </div>
                            </li>
                            @endif
                @endif
                @endif






            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
