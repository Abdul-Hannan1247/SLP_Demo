@extends('admin.layouts.master')




@section('content')
    <div class="container">
        <br><br>
        <h1>Trashed Patients</h1>

        @if (session('success'))
        <div id="success-notification" class="alert alert-success d-flex align-items-center position-fixed top-1 end-0 m-2" role="alert"
            style="top: 60px; z-index: 1050; background-color: #d4edda;">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                <use xlink:href="#check-circle-fill" />
            </svg>
            <div>
                {{ session('success') }}
            </div>
        </div>
    @endif

        <div class="row mb-4">
            <div class="col-md-12">
                <div class="d-flex align-items-center">
                    <div class="input-group rounded me-2">
                        <input type="text" name="search" id="searchInput" class="form-control rounded" placeholder="Search Trashed Patients..."
                            value="{{ request('search') }}">
                    </div>
                    <div class="input-group rounded">
                        <select name="sort" id="sortSelect" class="form-select rounded">
                            <option value="">Sort by Date</option>
                            <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>Oldest to Newest
                            </option>
                            <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>Newest to Oldest
                            </option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <table class="table table-striped table-hover table-bordered text-center" id="trashedPatientsTable">
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
                    <th style="font-size: 12px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($trashedPatients as $patient)
                    <tr>
                        <td><b>{{ ($trashedPatients->currentPage() - 1) * $trashedPatients->perPage() + $loop->iteration }}</b></td>
                        <td>
                            <div class="d-flex align-items-center justify-content-center">
                                @if ($patient->picture)
                                    <img src="{{ asset('storage/' . $patient->picture) }}" alt="Patient Picture" class="rounded mr-2" style="width: 60px; height: 60px; object-fit: cover;">
                                @else
                                    <img src="{{ asset('storage/avatar.png') }}" alt="Default Avatar" class="rounded mr-2" style="width: 60px; height: 60px; object-fit: cover;">
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
                        <td>
                            <div class="d-flex justify-content-center">
                                <form action="{{ route('patients.restore', $patient->id) }}" method="POST" class="mr-2">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-sm btn-success" title="Restore">
                                        <i class="bi bi-arrow-clockwise"></i>
                                    </button>
                                </form>
                                <button type="button" class="btn btn-sm btn-danger" title="Force Delete" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $patient->id }}">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>

                            <div class="modal fade" id="deleteModal{{ $patient->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $patient->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel{{ $patient->id }}">Confirm Deletion</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure you want to permanently delete this patient?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <form action="{{ route('patients.forceDelete', $patient->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete Permanently</button>
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
            {{ $trashedPatients->appends(request()->query())->links() }}
        </div>
    </div>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const sortSelect = document.getElementById('sortSelect');

            const updateTable = () => {
                const search = searchInput.value;
                const sort = sortSelect.value;
                const url = `{{ route('patients.trashed') }}?search=${search}&sort=${sort}`;

                fetch(url)
                    .then(response => response.text())
                    .then(html => {
                        const tempDiv = document.createElement('div');
                        tempDiv.innerHTML = html;
                        document.getElementById('trashedPatientsTable').querySelector('tbody').innerHTML = tempDiv.querySelector('#trashedPatientsTable tbody').innerHTML;
                        document.getElementById('pagination').innerHTML = tempDiv.querySelector('#pagination').innerHTML;
                    });
            };

            searchInput.addEventListener('input', updateTable);
            sortSelect.addEventListener('change', updateTable);
        });
    </script>
@endsection