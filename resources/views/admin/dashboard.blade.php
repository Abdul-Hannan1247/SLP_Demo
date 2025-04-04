@extends('admin.layouts.master')



@section('content')
            <!-- Page header -->
            <div class="page-header d-print-none">
                <div class="container-xl">
                    <div class="row g-2 align-items-center">
                        <div class="col">
                            <!-- Page pre-title -->
                            <div class="page-pretitle">
                                Overview
                            </div>
                            <h2 class="page-title">
                                Combo layout
                            </h2>
                        </div>
                        <!-- Page title actions -->
                        <div class="col-auto ms-auto d-print-none">
                            <div class="btn-list">
                                <span class="d-none d-sm-inline">
                                    <a href="#" class="btn">
                                        New view
                                    </a>
                                </span>
                                <a href="#" class="btn btn-primary d-none d-sm-inline-block"
                                    data-bs-toggle="modal" data-bs-target="#modal-report">
                                    <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M12 5l0 14" />
                                        <path d="M5 12l14 0" />
                                    </svg>
                                    Create new report
                                </a>
                                <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal"
                                    data-bs-target="#modal-report" aria-label="Create new report">
                                    <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M12 5l0 14" />
                                        <path d="M5 12l14 0" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Page body -->
            <div class="page-body">
                <div class="container-xl">
                    <div class="row row-deck row-cards">
                        <div class="page-body">
                            <div class="container-xl">
                                <div class="row row-cards">

                                    <div class="col-12">
                                        <div class="card">
                                            <div class="table-responsive">
                                                <table class="table table-vcenter card-table">
                                                    <thead>
                                                        <tr>
                                                            <th>Name</th>
                                                            <th>Title</th>
                                                            <th>Role</th>
                                                            <th class="w-1"></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <div class="d-flex py-1 align-items-center">
                                                                    <span class="avatar me-2"
                                                                        style="background-image: url(./static/avatars/006m.jpg)"></span>
                                                                    <div class="flex-fill">
                                                                        <div class="font-weight-medium">Lorry Mion
                                                                        </div>
                                                                        <div class="text-secondary"><a href="#"
                                                                                class="text-reset">lmiona@livejournal.com</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div>Automation Specialist IV</div>
                                                                <div class="text-secondary">Accounting</div>
                                                            </td>
                                                            <td class="text-secondary">
                                                                User
                                                            </td>
                                                            <td>
                                                                <a href="#">Edit</a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="d-flex py-1 align-items-center">
                                                                    <span class="avatar me-2"
                                                                        style="background-image: url(./static/avatars/004f.jpg)"></span>
                                                                    <div class="flex-fill">
                                                                        <div class="font-weight-medium">Leesa Beaty
                                                                        </div>
                                                                        <div class="text-secondary"><a href="#"
                                                                                class="text-reset">lbeatyb@alibaba.com</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div>Editor</div>
                                                                <div class="text-secondary">Services</div>
                                                            </td>
                                                            <td class="text-secondary">
                                                                Admin
                                                            </td>
                                                            <td>
                                                                <a href="#">Edit</a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="d-flex py-1 align-items-center">
                                                                    <span class="avatar me-2"
                                                                        style="background-image: url(./static/avatars/007m.jpg)"></span>
                                                                    <div class="flex-fill">
                                                                        <div class="font-weight-medium">Perren Keemar
                                                                        </div>
                                                                        <div class="text-secondary"><a href="#"
                                                                                class="text-reset">pkeemarc@yahoo.com</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div>Analog Circuit Design manager</div>
                                                                <div class="text-secondary">Services</div>
                                                            </td>
                                                            <td class="text-secondary">
                                                                User
                                                            </td>
                                                            <td>
                                                                <a href="#">Edit</a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="d-flex py-1 align-items-center">
                                                                    <span class="avatar me-2">SA</span>
                                                                    <div class="flex-fill">
                                                                        <div class="font-weight-medium">Sunny Airey
                                                                        </div>
                                                                        <div class="text-secondary"><a href="#"
                                                                                class="text-reset">saireyd@prlog.org</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div>Nuclear Power Engineer</div>
                                                                <div class="text-secondary">Engineering</div>
                                                            </td>
                                                            <td class="text-secondary">
                                                                Owner
                                                            </td>
                                                            <td>
                                                                <a href="#">Edit</a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="d-flex py-1 align-items-center">
                                                                    <span class="avatar me-2"
                                                                        style="background-image: url(./static/avatars/009m.jpg)"></span>
                                                                    <div class="flex-fill">
                                                                        <div class="font-weight-medium">Geoffry
                                                                            Flaunders</div>
                                                                        <div class="text-secondary"><a href="#"
                                                                                class="text-reset">gflaunderse@loc.gov</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div>Software Test Engineer II</div>
                                                                <div class="text-secondary">Accounting</div>
                                                            </td>
                                                            <td class="text-secondary">
                                                                Admin
                                                            </td>
                                                            <td>
                                                                <a href="#">Edit</a>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
@endsection