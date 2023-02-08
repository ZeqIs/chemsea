@extends('components.layout')

@section('title', 'Applications List')

@section('bottombar')
    @include('components.bottombar')
@endsection

@section('sidebar')
    @include('components.sidebar')
@endsection

@section('card-title', 'Applications List')

@section('content')
    <div class="mb-3 row">
        <div class="col">
            <button id="filter-all" type="button" class="btn btn-outline-primary">All</button>
            <button id="filter-open" type="button" class="btn btn-outline-primary">Open</button>
            <button id="filter-inProgress" type="button" class="btn btn-outline-primary">In
                Progress</button>
            <button id="filter-complete" type="button" class="btn btn-outline-primary">Complete</button>
            <button id="filter-rejected" type="button" class="btn btn-outline-primary">Rejected</button>
        </div>
    </div>
    <div class="mb-3 row">
        <div class="col">
            <table id="my-applications-table" class="table table-striped">
                <thead>
                    <tr>
                        <th class="text-center">Application ID</th>
                        <th class="text-center">Applicant</th>
                        <th class="text-center">Requested Services</th>
                        <th class="text-center">Date Created</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($applications as $application)
                        <tr>
                            <td>{{ $application->name }}</td>
                            <td>{{ $application->Applicant->first_name }} {{ $application->Applicant->last_name }}</td>
                            <td>
                                <ul class="list-unstyled">
                                    @foreach ($application->serviceRequest as $request)
                                        <li>{{ $request->serviceType->name }}</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>{{ $application->created_at }}</td>
                            <td>
                                @if ($application->status == 'In progress')
                                    <span class="badge bg-warning">In Progress</span>
                                @elseif($application->status == 'Complete')
                                    <span class="badge bg-success">Complete</span>
                                @elseif($application->status == 'Pending')
                                    <span class="badge bg-warning">Open</span>
                                @else
                                    <span class="badge bg-danger">Rejected</span>
                                @endif
                            </td>
                            <td>
                                @if ($application->status == 'Pending')
                                    <a href="/scientist/applications/{{ $application->id }}/review"
                                        class="btn btn-outline-primary mb-1">Review
                                        Application</a>
                                @elseif($application->status == 'Rejected')
                                    <a href="/applications/{{ $application->id }}" class="btn btn-outline-primary mb-1">View
                                        Application</a>
                                    <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal"
                                        data-bs-target="#rejectedReason">
                                        Show Reason
                                    </button>
                                @else
                                    <a href="/applications/{{ $application->id }}" class="btn btn-outline-primary mb-1">View
                                        Application</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            var table = $('#my-applications-table').DataTable({
                responsive: true,
                "columnDefs": [{
                        responsivePriority: 2,
                        "targets": 5,
                        "orderable": false
                    },
                    {
                        "targets": [2, 3, 4],
                        "className": "text-center d-flexalign-items-center"
                    },
                    {
                        responsivePriority: 6,
                        "targets": 3
                    },
                    {
                        responsivePriority: 1,
                        "targets": 0
                    },
                    {
                        responsivePriority: 5,
                        "targets": 2
                    },
                    {
                        responsivePriority: 4,
                        "targets": 1
                    },
                    {
                        responsivePriority: 3,
                        "targets": 4
                    }
                ]
            });
            $('#filter-all').on('click', function() {
                table.column(4).search("").draw();
            });
            $('#filter-complete').on('click', function() {
                table.column(4).search("Complete").draw();
            });
            $('#filter-inProgress').on('click', function() {
                table.column(4).search("In Progress").draw();
            });
            $('#filter-open').on('click', function() {
                table.column(4).search("Open").draw();
            });
            $('#filter-rejected').on('click', function() {
                table.column(4).search("Rejected").draw();
            });
        });
    </script>
@endsection
