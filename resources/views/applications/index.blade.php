@extends('components.layout')

@section('title', 'My Applications')

@section('bottombar')
    @include('components.bottombar')
@endsection

@section('sidebar')
    @include('components.sidebar')
@endsection

@section('card-title', 'My Applications')

@section('content')
    <div class="mb-3 row">
        <div class="col">
            <button id="filter-all" type="button" class="btn btn-outline-primary">All</button>
            <button id="filter-complete" type="button" class="btn btn-outline-primary">Complete</button>
            <button id="filter-inProgress" type="button" class="btn btn-outline-primary">In
                Progress</button>
            <button id="filter-pending" type="button" class="btn btn-outline-primary">Pending</button>
            <button id="filter-rejected" type="button" class="btn btn-outline-primary">Rejected</button>
        </div>
    </div>
    <div class="mb-3 row">
        <div class="col">
            <table id="my-applications-table" class="table table-striped">
                <thead>
                    <tr>
                        <th class="text-center">Application ID</th>
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
                            <td>
                                <ul class="list-unstyled">
                                    @foreach ($application->serviceRequest as $service)
                                        <li>{{ $service->serviceType->name }}</li>
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
                                    <span class="badge bg-warning">Pending</span>
                                @else
                                    <span class="badge bg-danger">Rejected</span>
                                @endif
                            </td>
                            <td>
                                @if ($application->status == 'Pending')
                                    <a href="/applications/{{ $application->id }}" class="btn btn-outline-primary mb-1">View
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
        @endsection

        @section('footer')
            <!-- Modal -->
            <div class="modal fade" id="rejectedReason" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="rejectedReasonLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="rejectedReasonLabel">Reason for rejection</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            @foreach ($applications as $application)
                                {{ $application->reason }}
                            @endforeach
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
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
                                "targets": 4,
                                "orderable": false
                            },
                            {
                                "targets": [2, 3, 4],
                                "className": "text-center d-flexalign-items-center"
                            },
                            {
                                responsivePriority: 3,
                                "targets": 3,
                                "searchable": true
                            },
                            {
                                responsivePriority: 1,
                                "targets": 0
                            },
                            {
                                responsivePriority: 4,
                                "targets": 2
                            },
                            {
                                responsivePriority: 5,
                                "targets": 1
                            }
                        ]
                    });
                    $('#filter-all').on('click', function() {
                        table.column(3).search("").draw();
                    });
                    $('#filter-complete').on('click', function() {
                        table.column(3).search("Complete").draw();
                    });
                    $('#filter-inProgress').on('click', function() {
                        table.column(3).search("In Progress").draw();
                    });
                    $('#filter-pending').on('click', function() {
                        table.column(3).search("Pending").draw();
                    });
                    $('#filter-rejected').on('click', function() {
                        table.column(3).search("Rejected").draw();
                    });
                });
            </script>
        @endsection
