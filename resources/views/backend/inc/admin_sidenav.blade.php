<div class="aiz-sidebar-wrap">
    <div class="aiz-sidebar left c-scrollbar">
        <div class="aiz-side-nav-logo-wrap">
            <a href="{{ route('admin.dashboard') }}" class="d-block text-left">
                @if (get_setting('system_logo_white') != null)
                    <img class="mw-100" src="{{ uploaded_asset(get_setting('system_logo_white')) }}"
                        class="brand-icon" alt="{{ get_setting('site_name') }}">
                @else
                    <img class="mw-100" src="{{ static_asset('assets/img/logo-white.png') }}"
                        class="brand-icon" alt="{{ get_setting('site_name') }}">
                @endif
            </a>
        </div>
        <div class="aiz-side-nav-wrap">
            <ul class="aiz-side-nav-list" data-toggle="aiz-side-menu">
                <li class="aiz-side-nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="aiz-side-nav-link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                            <path id="Path_18917" data-name="Path 18917"
                                d="M3.889,11.889H9.222A.892.892,0,0,0,10.111,11V3.889A.892.892,0,0,0,9.222,3H3.889A.892.892,0,0,0,3,3.889V11A.892.892,0,0,0,3.889,11.889Zm0,7.111H9.222a.892.892,0,0,0,.889-.889V14.556a.892.892,0,0,0-.889-.889H3.889A.892.892,0,0,0,3,14.556v3.556A.892.892,0,0,0,3.889,19Zm8.889,0h5.333A.892.892,0,0,0,19,18.111V11a.892.892,0,0,0-.889-.889H12.778a.892.892,0,0,0-.889.889v7.111A.892.892,0,0,0,12.778,19ZM11.889,3.889V7.444a.892.892,0,0,0,.889.889h5.333A.892.892,0,0,0,19,7.444V3.889A.892.892,0,0,0,18.111,3H12.778A.892.892,0,0,0,11.889,3.889Z"
                                transform="translate(-3 -3)" fill="#707070" />
                        </svg>
                        <span class="aiz-side-nav-text">{{ translate('Dashboard') }}</span>
                    </a>
                </li>
         

                <!-- Automate Attendance Management start -->
                @can('automate_attendance')
                <li class="aiz-side-nav-item">
                    <a href="#" class="aiz-side-nav-link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                            <g id="Group_23" data-name="Group 23" transform="translate(-126 -590)">
                                <path id="Subtraction_31" data-name="Subtraction 31"
                                    d="M15,16H1a1,1,0,0,1-1-1V1A1,1,0,0,1,1,0H4.8V4.4a2,2,0,0,0,2,2H9.2a2,2,0,0,0,2-2V0H15a1,1,0,0,1,1,1V15A1,1,0,0,1,15,16Z"
                                    transform="translate(126 590)" fill="#707070" />
                                <path id="Rectangle_93" data-name="Rectangle 93"
                                    d="M0,0H4A0,0,0,0,1,4,0V4A1,1,0,0,1,3,5H1A1,1,0,0,1,0,4V0A0,0,0,0,1,0,0Z"
                                    transform="translate(132 590)" fill="#707070" />
                            </g>
                        </svg>
                        <span class="aiz-side-nav-text">{{ translate('Automate Attendance Management') }}</span>
                        <span class="aiz-side-nav-arrow"></span>
                    </a>
                    <!--Submenu-->

                    <ul class="aiz-side-nav-list level-2">
                       @can('automate_attendance')
                            <li class="aiz-side-nav-item">
                                <a href="{{route('employee.automate_attendance')}}"
                                    class="aiz-side-nav-link {{ areActiveRoutes(['employee.automate_attendance']) }}">
                                    <span class="aiz-side-nav-text">
                                        {{ translate('Automate Attendance Report') }}
                                    </span>
                                </a>
                            </li>
                        @endcan
                        @can('automate_attendance')
                            <li class="aiz-side-nav-item">
                                <a href="{{route('employee.automate_attendance.list')}}"
                                    class="aiz-side-nav-link {{ areActiveRoutes(['employee.automate_attendance.list']) }}">
                                    <span class="aiz-side-nav-text">
                                        {{ translate('Automate Attendance List') }}
                                    </span>
                                </a>
                            </li>
                        @endcan
                        @can('automate_attendance')
                            <li class="aiz-side-nav-item">
                                <a href="{{route('employee.employee_panel.list')}}"
                                    class="aiz-side-nav-link {{ areActiveRoutes(['employee.employee_panel.list']) }}">
                                    <span class="aiz-side-nav-text">
                                        {{ translate('Employee List') }}
                                    </span>
                                </a>
                            </li>
                        @endcan
                        @can('automate_attendance')
                            <li class="aiz-side-nav-item">
                                <a href="{{route('employee.employee_current_attendance.data')}}"
                                    class="aiz-side-nav-link {{ areActiveRoutes(['employee.employee_current_attendance.data']) }}">
                                    <span class="aiz-side-nav-text">
                                        {{ translate('Employee Current Attendance') }}
                                    </span>
                                </a>
                            </li>
                        @endcan
                       
                    </ul>
                </li>
                @endcan
                <!-- Automate Attendance Management end -->


            </ul><!-- .aiz-side-nav -->
        </div><!-- .aiz-side-nav-wrap -->
    </div><!-- .aiz-sidebar -->
    <div class="aiz-sidebar-overlay"></div>
</div><!-- .aiz-sidebar -->
