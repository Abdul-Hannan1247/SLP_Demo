@extends('admin.layouts.master')

@section('content')
    <div class="container">
        <h1>Admin Dashboard</h1>

        <div class="row">
            <div class="col-md-2">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Patients</h5>
                        <p class="card-text" style="font-size:26px;"> {{ $totalPatients ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Appointments This Month</h5>
                        <p class="card-text" style="font-size:26px;"> {{ $totalAppointmentsThisMonth ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>

        </div>

        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Patient Registrations Over Time</h5>
                        <canvas id="registrationChart" width="400" height="300"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Patient Gender Distribution</h5>
                        <canvas id="genderChart" width="400" height="300"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Diagnose Distribution</h5>
                        <canvas id="diagnoseChart" width="400" height="300"></canvas>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Patient Registration Over Time Chart (Keep this as is)
        const registrationCtx = document.getElementById('registrationChart').getContext('2d');
        const registrationChart = new Chart(registrationCtx, {
            type: 'line',
            data: {
                labels: @json($months ?? []),
                datasets: [{
                    label: 'New Patient Registrations',
                    data: @json($counts ?? []),
                    borderColor: 'rgb(75, 192, 192)',
                    tension: 0.4
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Patient Gender Distribution Chart (Keep this as is)
        const genderCtx = document.getElementById('genderChart').getContext('2d');
        const genderChart = new Chart(genderCtx, {
            type: 'bar',
            data: {
                labels: @json($genders ?? []),
                datasets: [{
                    label: 'Patient Gender Distribution',
                    data: @json($genderCountsData ?? []),
                    backgroundColor: [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                        'rgb(255, 205, 86)'
                    ],
                    hoverOffset: 4
                }]
            },
        });

        // Diagnose Distribution Chart
        const diagnoseCtx = document.getElementById('diagnoseChart').getContext('2d');
        const diagnoseChart = new Chart(diagnoseCtx, {
            type: 'bar', // You can also use 'pie' or 'doughnut'
            data: {
                labels: @json($diagnoseLabels ?? []),
                datasets: [{
                    label: 'Diagnose Count',
                    data: @json($diagnoseCounts ?? []),
                    backgroundColor: [
                        'rgba(153, 102, 255, 0.8)',
                        'rgba(255, 206, 86, 0.8)',
                        'rgba(75, 192, 192, 0.8)',
                        'rgba(54, 162, 235, 0.8)',
                        'rgba(255, 159, 64, 0.8)',
                        'rgba(128, 0, 128, 0.8)',   // Purple
                        'rgba(255, 99, 132, 0.8)',
                        'rgba(0, 128, 0, 0.8)',     // Green
                        // Add more colors as needed
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(128, 0, 128, 1)',
                        'rgba(0, 128, 0, 1)',
                        // Add more border colors as needed
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Number of Patients'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Diagnose'
                        },
                        ticks: {
                            autoSkip: false,
                            maxRotation: 90,
                            minRotation: 30
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false,
                    },
                    title: {
                        display: true,
                        text: 'Distribution of Patient Diagnoses'
                    }
                }
            }
        });
    </script>
@endpush
