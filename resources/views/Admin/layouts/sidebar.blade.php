{{-- ----------------------------------------------------- --}}
{{-- Working side bar  Start --}}
{{-- ----------------------------------------------------- --}}

<aside class="navbar navbar-vertical navbar-expand-lg" data-bs-theme="dark">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-menu"
            aria-controls="sidebar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <h1 class="navbar-brand navbar-brand-autodark">
            <a href="#">
                {{-- <img src="./static/logo.svg" width="110" height="32" alt="Tabler" class="navbar-brand-image"> --}}
                <br>
                <h2 style="font-family: 'Montserrat', sans-serif;">Lingua Link</h2>       
            
            </a>
        </h1>
        <div class="navbar-nav flex-row d-lg-none">
        </div>
        <div class="collapse navbar-collapse" id="sidebar-menu">
            <ul class="navbar-nav pt-lg-3">
                <li class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.dashboard') }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-layout-board-split"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 4m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" /><path d="M4 12h8" /><path d="M12 15h8" /><path d="M12 9h8" /><path d="M12 4v16" /></svg>
                        </span>
                        <span class="nav-link-title">
                          &nbsp; Dashboard
                        </span>
                    </a>
                </li>
                <li class="nav-item {{ request()->routeIs('appointments.calendar') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('appointments.calendar') }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-calendar"
                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path
                                    d="M4 5h16a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-16a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2">
                                </path>
                                <path d="M16 3v4"></path>
                                <path d="M8 3v4"></path>
                                <path d="M4 11h16"></path>
                                <path d="M11 15h1"></path>
                                <path d="M12 15v3"></path>
                            </svg>
                        </span>
                        <span class="nav-link-title">
                            Calendar
                        </span>
                    </a>
                </li>

                {{-- Appointments --}}
                <li class="nav-item dropdown {{ request()->routeIs('appointments.*') ? 'active show' : '' }}">
                    <a class="nav-link dropdown-toggle" href="#navbar-appointments" data-bs-toggle="dropdown"
                        data-bs-auto-close="false" role="button"
                        aria-expanded="{{ request()->routeIs('appointments.*') ? 'true' : 'false' }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-calendar-plus"
                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 5v14"></path>
                                <path d="M5 12h14"></path>
                                <path d="M15 3v4"></path>
                                <path d="M7 3v4"></path>
                            </svg>
                        </span>
                        <span class="nav-link-title">
                            Appointments
                        </span>
                    </a>
                    <div class="dropdown-menu {{ request()->routeIs('appointments.*') ? 'show' : '' }}">
                        <a class="dropdown-item {{ request()->routeIs('appointments.create') ? 'active' : '' }}"
                            href="{{ route('appointments.create') }}">
                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-calendar-check"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M11.5 21h-5.5a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v6" /><path d="M16 3v4" /><path d="M8 3v4" /><path d="M4 11h16" /><path d="M15 19l2 2l4 -4" /></svg>
                          &nbsp; Add Appointment
                        </a>
                        <a class="dropdown-item {{ request()->routeIs('appointments.index') ? 'active' : '' }}"
                            href="{{ route('appointments.index') }}">
                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-clipboard-list"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" /><path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" /><path d="M9 12l.01 0" /><path d="M13 12l2 0" /><path d="M9 16l.01 0" /><path d="M13 16l2 0" /></svg>
                           &nbsp;All Appointments
                        </a>
                    </div>
                </li>

                {{-- Patients --}}
                <li class="nav-item dropdown {{ request()->routeIs('patients.*') ? 'active show' : '' }}">
                    <a class="nav-link dropdown-toggle" href="#navbar-patients" data-bs-toggle="dropdown"
                        data-bs-auto-close="false" role="button"
                        aria-expanded="{{ request()->routeIs('patients.*') ? 'true' : 'false' }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-wheelchair">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M8 16m-5 0a5 5 0 1 0 10 0a5 5 0 1 0 -10 0" />
                                <path d="M19 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                <path d="M19 17a3 3 0 0 0 -3 -3h-3.4" />
                                <path d="M3 3h1a2 2 0 0 1 2 2v6" />
                                <path d="M6 8h11" />
                                <path d="M15 8v6" />
                            </svg>
                        </span>
                        <span class="nav-link-title">
                            Patients
                        </span>
                    </a>
                    <div class="dropdown-menu {{ request()->routeIs('patients.*') ? 'show' : '' }}">
                        <a class="dropdown-item {{ request()->routeIs('patients.index') ? 'active' : '' }}"
                            href="{{ route('patients.index') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users me-2"
                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                                <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                <path d="M16 16v-2a4 4 0 0 0 -4 -4h-4a4 4 0 0 0 -4 4v2" />
                            </svg>
                            All Patients
                        </a>
                        <a class="dropdown-item {{ request()->routeIs('patients.create') ? 'active' : '' }}"
                            href="{{ route('patients.create') }}">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="icon icon-tabler icon-tabler-user-plus me-2" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                <path d="M16 19h6" />
                                <path d="M19 16v6" />
                                <path d="M6 21v-2a4 4 0 0 1 4 -4h4" />
                            </svg>
                            Create New Patient
                        </a>
                        <a class="dropdown-item {{ request()->routeIs('patients.trashed') ? 'active' : '' }}"
                            href="{{ route('patients.trashed') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash-x me-2"
                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M4 7h16" />
                                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                <path d="M9 9v-4a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4" />
                                <path d="M10 12l4 4m0 -4l-4 4" />
                            </svg>
                            Deleted Patients
                        </a>
                    </div>
                </li>

                {{-- Staff --}}
                <li class="nav-item dropdown {{ request()->routeIs('appointments.*') ? 'active show' : '' }}">
                    <a class="nav-link dropdown-toggle" href="#navbar-appointments" data-bs-toggle="dropdown"
                        data-bs-auto-close="false" role="button"
                        aria-expanded="{{ request()->routeIs('appointments.*') ? 'true' : 'false' }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-users"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" /><path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /><path d="M16 3.13a4 4 0 0 1 0 7.75" /><path d="M21 21v-2a4 4 0 0 0 -3 -3.85" /></svg>
                        </span>
                        <span class="nav-link-title">
                            &nbsp;  Staff
                        </span>
                    </a>
                    <div class="dropdown-menu {{ request()->routeIs('appointments.*') ? 'show' : '' }}">
                        <a class="dropdown-item {{ request()->routeIs('appointments.create') ? 'active' : '' }}"
                            href="{{ route('appointments.create') }}">
                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-checks"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 12l5 5l10 -10" /><path d="M2 12l5 5m5 -5l5 -5" /></svg>
                            &nbsp; Active Members
                        </a>
                        <a class="dropdown-item {{ request()->routeIs('appointments.index') ? 'active' : '' }}"
                            href="{{ route('appointments.index') }}">
                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-x"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M18 6l-12 12" /><path d="M6 6l12 12" /></svg>
                            &nbsp; Inactive Members
                        </a>
                    </div>
                </li>

                {{-- Resources --}}
                <li class="nav-item dropdown {{ request()->routeIs('appointments.*') ? 'active show' : '' }}">
                    <a class="nav-link dropdown-toggle" href="#navbar-appointments" data-bs-toggle="dropdown"
                        data-bs-auto-close="false" role="button" aria-expanded="{{ request()->routeIs('appointments.*') ? 'true' : 'false' }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-folder-dollar"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M13.5 19h-8.5a2 2 0 0 1 -2 -2v-11a2 2 0 0 1 2 -2h4l3 3h7a2 2 0 0 1 2 2v1.5" /><path d="M21 15h-2.5a1.5 1.5 0 0 0 0 3h1a1.5 1.5 0 0 1 0 3h-2.5" /><path d="M19 21v1m0 -8v1" /></svg>
                        </span>
                        <span class="nav-link-title">
                            &nbsp; Resources
                        </span>
                    </a>
                    <div class="dropdown-menu {{ request()->routeIs('appointments.*') ? 'show' : '' }}">
                        <a class="dropdown-item {{ request()->routeIs('appointments.create') ? 'active' : '' }}" href="{{ route('appointments.create') }}">
                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-tools"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 21h4l13 -13a1.5 1.5 0 0 0 -4 -4l-13 13v4" /><path d="M14.5 5.5l4 4" /><path d="M12 8l-5 -5l-4 4l5 5" /><path d="M7 8l-1.5 1.5" /><path d="M16 12l5 5l-4 4l-5 -5" /><path d="M16 17l-1.5 1.5" /></svg>
                            &nbsp; Therapy Tools
                        </a>
                        <a class="dropdown-item {{ request()->routeIs('games.find_item_game') ? 'active' : '' }}" href="{{ route('games.find_item_game') }}">
                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-device-gamepad-2"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5h3.5a5 5 0 0 1 0 10h-5.5l-4.015 4.227a2.3 2.3 0 0 1 -3.923 -2.035l1.634 -8.173a5 5 0 0 1 4.904 -4.019h3.4z" /><path d="M14 15l4.07 4.284a2.3 2.3 0 0 0 3.925 -2.023l-1.6 -8.232" /><path d="M8 9v2" /><path d="M7 10h2" /><path d="M14 10h2" /></svg>
                             &nbsp; Games
                        </a>
                    </div>
                </li>

                {{-- Reports --}}
                <li class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.dashboard') }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-chart-bar"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 13a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v6a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" /><path d="M15 9a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v10a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" /><path d="M9 5a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v14a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" /><path d="M4 20h14" /></svg>
                        </span>
                        <span class="nav-link-title">
                            &nbsp; Reports
                        </span>
                    </a>
                </li>

            </ul>
        </div>
    </div>
</aside>

{{-- ---------------------------------------------------------------? --}}
{{-- Working side bar  End --}}
{{-- ---------------------------------------------------------------? --}}
