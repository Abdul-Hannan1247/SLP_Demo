@extends('admin.layouts.master')

@section('content')
    <div class="container">
        <div class="row mb-4">
            <div class="col-md-12">
                <h2>Appointments</h2>

                @if (session('success'))
                    <div id="success-notification" class="alert alert-success alert-dismissible fade show d-flex align-items-center position-fixed top-2 end-0 m-3" role="alert"
                         style="top: 60px; z-index: 1050; background-color: #d4edda;">
                        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                            <use xlink:href="#check-circle-fill" />
                        </svg>
                        <div>
                            {{ session('success') }}
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <a href="{{ route('appointments.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus"></i> Add Appointment
                </a>
            </div>
        </div>

        <div class="row mb-3 align-items-center">
            <div class="col-md-4">
                <input type="text" id="search-patient" class="form-control" placeholder="Search Patient Name">
            </div>
            <div class="col-md-3">
                <input type="date" id="filter-date" class="form-control">
            </div>
            <div class="col-md-3 d-flex align-items-center">
                <select id="filter-time" class="form-control me-2">
                    <option value="">All Times</option>
                    <option value="AM">AM</option>
                    <option value="PM">PM</option>
                </select>
                <button type="button" id="clear-filter" class="btn btn-outline-secondary btn-sm me-2">
                    <i class="bi bi-x-circle"></i> Clear
                </button>
            </div>

        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-bordered text-center" id="appointments-table">
                                <thead>
                                    <tr>
                                        <th class="fs-4">#</th>
                                        <th class="fs-4 sortable" data-sort="patient_name">Patient Name <i class="bi bi-arrow-down-up"></i></th>
                                        <th class="fs-4 sortable" data-sort="date">Date <i class="bi bi-arrow-down-up"></i></th>
                                        <th class="fs-4 sortable" data-sort="time">Time <i class="bi bi-arrow-down-up"></i></th>
                                        <th class="fs-4">Notes</th>
                                        <th class="fs-4">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($appointments as $appointment)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $appointment->patient_name }}</td>
                                            <td data-date="{{ $appointment->date }}">{{ \Carbon\Carbon::parse($appointment->date)->format('d M, Y') }}</td>
                                            <td data-time="{{ \Carbon\Carbon::parse($appointment->time)->format('H:i:s') }}">
                                                {{ \Carbon\Carbon::parse($appointment->time)->format('h:i A') }}
                                            </td>
                                            <td>{{ $appointment->appointment_notes }}</td>
                                            <td>
                                                <div class="d-flex justify-content-center">
                                                    <a href="{{ route('appointments.edit', $appointment->id) }}" class="btn btn-sm btn-primary me-2">
                                                        <i class="bi bi-pencil"></i> Edit
                                                    </a>
                                                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $appointment->id }}">
                                                        <i class="bi bi-trash"></i> Delete
                                                    </button>

                                                    <div class="modal fade" id="deleteModal{{ $appointment->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $appointment->id }}" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header bg-danger text-white">
                                                                    <h5 class="modal-title" id="deleteModalLabel{{ $appointment->id }}">Confirm Delete</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Are you sure you want to delete the appointment for <strong>{{ $appointment->patient_name }}</strong> on {{ \Carbon\Carbon::parse($appointment->date)->format('d M, Y') }} at {{ \Carbon\Carbon::parse($appointment->time)->format('h:i A') }}?
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                                    <form action="{{ route('appointments.destroy', $appointment->id) }}" method="POST" class="d-inline">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" class="btn btn-danger">
                                                                            <i class="bi bi-trash"></i> Delete
                                                                        </button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const notification = document.getElementById('success-notification');
            if (notification) {
                notification.classList.remove('fade', 'show');
                notification.style.opacity = 0;
                notification.style.transition = 'opacity 1s ease-in-out';
                setTimeout(function() {
                    notification.style.opacity = 1;
                }, 100);
                setTimeout(function() {
                    notification.style.opacity = 0;
                    setTimeout(function() {
                        notification.remove();
                    }, 1000);
                }, 3000);
            }

            const searchInput = document.getElementById('search-patient');
            const filterDateInput = document.getElementById('filter-date');
            const filterTimeSelect = document.getElementById('filter-time');
            const clearFilterButton = document.getElementById('clear-filter');
            const sortableHeaders = document.querySelectorAll('#appointments-table th.sortable');
            const table = document.getElementById('appointments-table');
            const tableBody = table.querySelector('tbody');
            let currentSortColumn = null;
            let sortDirection = 'asc';
            let allAppointmentsData = []; // Store the raw data for sorting

            // Function to extract data from table rows
            const getAppointmentData = (row) => ({
                patient_name: row.cells[1].textContent.trim(),
                date: row.cells[2].dataset.date,
                time: row.cells[3].dataset.time,
                time_display: row.cells[3].textContent.trim(),
                notes: row.cells[4].textContent.trim(),
                actions: row.cells[5].innerHTML, // Keep the HTML for actions
                originalRow: row // Keep a reference to the original row for re-insertion
            });

            // Initialize allAppointmentsData
            tableBody.querySelectorAll('tr').forEach(row => {
                allAppointmentsData.push(getAppointmentData(row));
            });

            const sortTable = (column) => {
                if (!allAppointmentsData.length) return;

                allAppointmentsData.sort((a, b) => {
                    let valueA, valueB;

                    if (column === 'date') {
                        valueA = a.date;
                        valueB = b.date;
                    } else if (column === 'time') {
                        valueA = a.time;
                        valueB = b.time;
                    } else if (column === 'patient_name') {
                        valueA = a.patient_name.toLowerCase();
                        valueB = b.patient_name.toLowerCase();
                    }

                    if (valueA < valueB) return sortDirection === 'asc' ? -1 : 1;
                    if (valueA > valueB) return sortDirection === 'asc' ? 1 : -1;
                    return 0;
                });

                renderTable(allAppointmentsData);

                if (currentSortColumn === column) {
                    sortDirection = sortDirection === 'asc' ? 'desc' : 'asc';
                } else {
                    currentSortColumn = column;
                    sortDirection = 'asc';
                }

                // Update sort icons
                sortableHeaders.forEach(th => th.querySelector('i').classList.remove('bi-arrow-up', 'bi-arrow-down'));
                const currentHeader = Array.from(sortableHeaders).find(th => th.dataset.sort === currentSortColumn);
                if (currentHeader) {
                    currentHeader.querySelector('i').classList.add(sortDirection === 'asc' ? 'bi-arrow-down' : 'bi-arrow-up');
                }
            };

            sortableHeaders.forEach(header => {
                header.addEventListener('click', function() {
                    sortTable(this.dataset.sort);
                });
            });

            const filterTable = (searchTerm, filterDate, filterTime) => {
                const filteredData = allAppointmentsData.filter(appointment => {
                    const patientNameMatch = searchTerm === '' || appointment.patient_name.toLowerCase().includes(searchTerm);
                    const dateMatch = filterDate === '' || appointment.date === filterDate;
                    const timeMatch = filterTime === '' || appointment.time_display.includes(filterTime);
                    return patientNameMatch && dateMatch && timeMatch;
                });
                renderTable(filteredData);
                if (currentSortColumn) {
                    sortTable(currentSortColumn);
                }
            };

            const renderTable = (data) => {
                tableBody.innerHTML = '';
                let i = 1;
                data.forEach(item => {
                    const row = tableBody.insertRow();
                    row.insertCell().textContent = i++;
                    row.insertCell().textContent = item.patient_name;
                    row.insertCell().textContent = item.date ? new Date(item.date).toLocaleDateString('en-US', { year: 'numeric', month: 'short', day: 'numeric' }) : '';
                    row.insertCell().textContent = item.time_display;
                    row.insertCell().textContent = item.notes;
                    row.insertCell().innerHTML = item.actions;
                    row.cells[2].dataset.date = item.date;
                    row.cells[3].dataset.time = item.time;
                });
            };

            searchInput.addEventListener('input', function() {
                filterTable(this.value.toLowerCase(), filterDateInput.value, filterTimeSelect.value);
            });

            filterDateInput.addEventListener('input', function() {
                filterTable(searchInput.value.toLowerCase(), this.value, filterTimeSelect.value);
            });

            filterTimeSelect.addEventListener('change', function() {
                filterTable(searchInput.value.toLowerCase(), filterDateInput.value, this.value);
            });

            clearFilterButton.addEventListener('click', function() {
                searchInput.value = '';
                filterDateInput.value = '';
                filterTimeSelect.value = '';
                renderTable(allAppointmentsData); // Re-render the full data
                currentSortColumn = null;
                sortDirection = 'asc';
                sortableHeaders.forEach(th => th.querySelector('i').classList.remove('bi-arrow-up', 'bi-arrow-down'));
            });

            // Initial rendering (optional, but good practice)
            renderTable(allAppointmentsData);
        });
    </script>
@endpush

