@extends('admin.layouts.master')

@section('content')
    <div class="container">
        <br><br>
        <h1>All Patients</h1>

        @if (session('success'))
            <div id="success-notification" class="alert alert-success d-flex align-items-center position-fixed top-2 end-0 m-3" role="alert"
                 style="top: 60px; z-index: 1050; background-color: #d4edda;">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                    <use xlink:href="#check-circle-fill"/>
                </svg>
                <div>
                    {{ session('success') }}
                </div>
            </div>
        @endif
        <br>
        <div class="row mb-4">
            <div class="col-md-12">
                <a href="{{ route('patients.create') }}" class="btn btn-primary mb-3 text">Create New Patient</a>
                <div class="d-flex align-items-center">
                    <div class="input-group rounded me-2">
                        <input type="text" name="search" id="searchInput" class="form-control rounded" placeholder="Search by Patients data mentioned in Coloumn..."
                               value="{{ request('search') }}">
                        @if(request('search'))
                            <button class="btn btn-outline-secondary" type="button" id="clearSearch">
                                <i class="bi bi-x-lg"></i>
                            </button>
                        @endif
                    </div>
                    <div class="input-group rounded">
                        <select name="sort" id="sortSelect" class="form-select rounded">
                            <option value="">Sort by Date</option>
                            <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>Oldest to Youngest
                            </option>
                            <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>Youngest to Oldest
                            </option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <table class="table table-striped table-hover table-bordered text-center" id="patientsTable">
            <thead>
            <tr>
                <th style="font-size: 12px;">#</th>
                <th style="font-size: 12px;">Name</th>
                <th style="font-size: 12px;">Email</th>
                <th style="font-size: 12px;">Gender</th>
                <th style="font-size: 12px;">Date of Birth</th>
                <th style="font-size: 12px;">Phone</th>
                <th style="font-size: 12px;">Emergency Contact</th>
                <th style="font-size: 12px;">Address</th>
                <th style="font-size: 12px;">Referral</th>
                <th style="font-size: 12px;">Diagnose</th>
                <th style="font-size: 12px;">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($patients as $patient)
                <tr>
                    <td><b>{{ ($patients->currentPage() - 1) * $patients->perPage() + $loop->iteration }}</b></td>
                    <td>
                        <div class="d-flex align-items-center justify-content-center">
                            @if ($patient->picture)
                                <img src="{{ asset('storage/' . $patient->picture) }}" alt="Patient Picture"
                                     class="rounded mr-2" style="width: 60px; height: 60px; object-fit: cover;">
                            @else
                                <img src="{{ asset('storage/avatar.png') }}" alt="Default Avatar" class="rounded mr-2"
                                     style="width: 60px; height: 60px; object-fit: cover;">
                            @endif
                            {{ $patient->name }}
                        </div>
                    </td>
                    <td>{{ $patient->email ? $patient->email : '-' }}</td>
                    <td>{{ $patient->gender }}</td>
                    <td>{{ $patient->date_of_birth }}</td>
                    <td>{{ $patient->phone }}</td>
                    <td>{{ $patient->emergency_contact }}</td>
                    <td>{{ $patient->address }}</td>
                    <td>{{ $patient->referral ? $patient->referral : 'N/A' }}</td>
                    <td>{{ $patient->diagnose ? Str::limit($patient->diagnose, 50, '...') : 'N/A' }}</td>
                    <td>
                        <a href="{{ route('patients.show', $patient->id) }}" title="View"><i class="bi bi-eye"></i></a>
                        <a href="{{ route('patients.edit', $patient->id) }}" title="Edit"><i class="bi bi-pencil"></i></a>
                        <button type="button" class="btn btn-link p-0" data-bs-toggle="modal"
                                data-bs-target="#deleteModal{{ $patient->id }}" title="Delete">
                            <i class="bi bi-trash"></i>
                        </button>

                        <div class="modal fade" id="deleteModal{{ $patient->id }}" tabindex="-1"
                             aria-labelledby="deleteModalLabel{{ $patient->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-danger text-white">
                                        <h5 class="modal-title" id="deleteModalLabel{{ $patient->id }}">Confirm Delete
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to delete patient: <b>{{ $patient->name }}</b>?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Cancel</button>
                                        <form action="{{ route('patients.destroy', $patient->id) }}" method="POST"
                                              style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center" id="pagination">
            {{ $patients->appends(request()->query())->links() }}
        </div>
    </div>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('searchInput');
            const sortSelect = document.getElementById('sortSelect');
            const patientsTableBody = document.querySelector('#patientsTable tbody');
            const paginationDiv = document.getElementById('pagination');
            const clearSearchButton = document.getElementById('clearSearch');

            const updateTable = () => {
                const search = searchInput.value;
                const sort = sortSelect.value;
                const url = `{{ route('patients.index') }}?search=${search}&sort=${sort}`;

                fetch(url)
                    .then(response => response.text())
                    .then(html => {
                        const tempDiv = document.createElement('div');
                        tempDiv.innerHTML = html;
                        patientsTableBody.innerHTML = tempDiv.querySelector('#patientsTable tbody').innerHTML;
                        paginationDiv.innerHTML = tempDiv.querySelector('#pagination').innerHTML;

                        // Update clear button visibility after table update
                        if (searchInput.value) {
                            if (!document.getElementById('clearSearch')) {
                                const clearButton = document.createElement('button');
                                clearButton.classList.add('btn', 'btn-outline-secondary');
                                clearButton.type = 'button';
                                clearButton.id = 'clearSearch';
                                clearButton.innerHTML = '<i class="bi bi-x-lg"></i>';
                                searchInput.parentNode.appendChild(clearButton);
                                clearButton.addEventListener('click', clearSearchInput);
                            }
                        } else {
                            const clearButton = document.getElementById('clearSearch');
                            if (clearButton) {
                                clearButton.remove();
                            }
                        }
                    });
            };

            const clearSearchInput = () => {
                searchInput.value = '';
                updateTable();
            };

            searchInput.addEventListener('input', updateTable);
            sortSelect.addEventListener('change', updateTable);

            // Initial setup for clear button if there's a search query on page load
            if (searchInput.value) {
                const clearButton = document.createElement('button');
                clearButton.classList.add('btn', 'btn-outline-secondary');
                clearButton.type = 'button';
                clearButton.id = 'clearSearch';
                clearButton.innerHTML = '<i class="bi bi-x-lg"></i>';
                searchInput.parentNode.appendChild(clearButton);
                clearButton.addEventListener('click', clearSearchInput);
            }

            const notification = document.getElementById('success-notification');
            if (notification) {
                setTimeout(function () {
                    notification.classList.remove('show');
                    setTimeout(function () {
                        notification.remove();
                    }, 500);
                }, 2000);
            }
        });
    </script>
@endsection