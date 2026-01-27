@extends('layouts.admin')

@section('title', 'Admin Dashboard - Doccure')

@section('content')
<!-- Page Header -->
<div class="page-header">
    <div class="row">
        <div class="col-sm-12">
            <h3 class="page-title">Welcome Admin!</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item active">Dashboard</li>
            </ul>
        </div>
    </div>
</div>
<!-- /Page Header -->

<div class="row">
    <div class="col-xl-3 col-sm-6 col-12">
        <div class="card">
            <div class="card-body">
                <div class="dash-widget-header">
                    <span class="dash-widget-icon text-primary border-primary">
                        <i class="fas fa-user-md"></i>
                    </span>
                    <div class="dash-count">
                        <h3>168</h3>
                    </div>
                </div>
                <div class="dash-widget-info">
                    <h6 class="text-muted">Doctors</h6>
                    <div class="progress progress-sm">
                        <div class="progress-bar bg-primary" style="width: 50%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 col-12">
        <div class="card">
            <div class="card-body">
                <div class="dash-widget-header">
                    <span class="dash-widget-icon text-success">
                        <i class="fas fa-user-injured"></i>
                    </span>
                    <div class="dash-count">
                        <h3>487</h3>
                    </div>
                </div>
                <div class="dash-widget-info">
                    <h6 class="text-muted">Patients</h6>
                    <div class="progress progress-sm">
                        <div class="progress-bar bg-success" style="width: 60%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 col-12">
        <div class="card">
            <div class="card-body">
                <div class="dash-widget-header">
                    <span class="dash-widget-icon text-danger border-danger">
                        <i class="fas fa-calendar-check"></i>
                    </span>
                    <div class="dash-count">
                        <h3>485</h3>
                    </div>
                </div>
                <div class="dash-widget-info">
                    <h6 class="text-muted">Appointments</h6>
                    <div class="progress progress-sm">
                        <div class="progress-bar bg-danger" style="width: 70%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 col-12">
        <div class="card">
            <div class="card-body">
                <div class="dash-widget-header">
                    <span class="dash-widget-icon text-warning border-warning">
                        <i class="fas fa-dollar-sign"></i>
                    </span>
                    <div class="dash-count">
                        <h3>$62523</h3>
                    </div>
                </div>
                <div class="dash-widget-info">
                    <h6 class="text-muted">Revenue</h6>
                    <div class="progress progress-sm">
                        <div class="progress-bar bg-warning" style="width: 80%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Appointments -->
<div class="row">
    <div class="col-md-12">
        <div class="card card-table">
            <div class="card-header">
                <h4 class="card-title">Recent Appointments</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-center mb-0">
                        <thead>
                            <tr>
                                <th>Doctor Name</th>
                                <th>Speciality</th>
                                <th>Patient Name</th>
                                <th>Apointment Time</th>
                                <th>Status</th>
                                <th class="text-end">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="table-avatar">
                                    <a href="{{ route('admin.doctors.index') }}" class="avatar avatar-sm me-2">
                                        <img class="avatar-img rounded-circle" src="{{ asset('assets/img/doctors/doctor-thumb-01.jpg') }}" alt="User Image">
                                    </a>
                                    <a href="{{ route('admin.doctors.index') }}">Dr. Ruby Perrin</a>
                                </td>
                                <td>Dental</td>
                                <td>
                                    <a href="{{ route('admin.patients') }}" class="avatar avatar-sm me-2">
                                        <img class="avatar-img rounded-circle" src="{{ asset('assets/img/patients/patient1.jpg') }}" alt="User Image">
                                    </a>
                                    <a href="{{ route('admin.patients') }}">Charlene Reed</a>
                                </td>
                                <td>9 Nov 2019 <span class="text-primary d-block">11.00 AM - 11.15 AM</span></td>
                                <td>
                                    <div class="status-toggle">
                                        <input type="checkbox" id="status_1" class="check" checked>
                                        <label for="status_1" class="checktoggle">checkbox</label>
                                    </div>
                                </td>
                                <td class="text-end">$200.00</td>
                            </tr>
                            <tr>
                                <td class="table-avatar">
                                    <a href="{{ route('admin.doctors.index') }}" class="avatar avatar-sm me-2">
                                        <img class="avatar-img rounded-circle" src="{{ asset('assets/img/doctors/doctor-thumb-02.jpg') }}" alt="User Image">
                                    </a>
                                    <a href="{{ route('admin.doctors.index') }}">Dr. Darren Elder</a>
                                </td>
                                <td>Dental</td>
                                <td>
                                    <a href="{{ route('admin.patients') }}" class="avatar avatar-sm me-2">
                                        <img class="avatar-img rounded-circle" src="{{ asset('assets/img/patients/patient2.jpg') }}" alt="User Image">
                                    </a>
                                    <a href="{{ route('admin.patients') }}">Travis Trimble</a>
                                </td>
                                <td>5 Nov 2019 <span class="text-primary d-block">11.00 AM - 11.35 AM</span></td>
                                <td>
                                    <div class="status-toggle">
                                        <input type="checkbox" id="status_2" class="check" checked>
                                        <label for="status_2" class="checktoggle">checkbox</label>
                                    </div>
                                </td>
                                <td class="text-end">$300.00</td>
                            </tr>
                            <tr>
                                <td class="table-avatar">
                                    <a href="{{ route('admin.doctors.index') }}" class="avatar avatar-sm me-2">
                                        <img class="avatar-img rounded-circle" src="{{ asset('assets/img/doctors/doctor-thumb-03.jpg') }}" alt="User Image">
                                    </a>
                                    <a href="{{ route('admin.doctors.index') }}">Dr. Deborah Angel</a>
                                </td>
                                <td>Cardiology</td>
                                <td>
                                    <a href="{{ route('admin.patients') }}" class="avatar avatar-sm me-2">
                                        <img class="avatar-img rounded-circle" src="{{ asset('assets/img/patients/patient3.jpg') }}" alt="User Image">
                                    </a>
                                    <a href="{{ route('admin.patients') }}">Carl Kelly</a>
                                </td>
                                <td>11 Nov 2019 <span class="text-primary d-block">12.00 PM - 12.15 PM</span></td>
                                <td>
                                    <div class="status-toggle">
                                        <input type="checkbox" id="status_3" class="check" checked>
                                        <label for="status_3" class="checktoggle">checkbox</label>
                                    </div>
                                </td>
                                <td class="text-end">$150.00</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Recent Appointments -->
@endsection
