@extends('components.layout')

@section('title', 'My Reports')

@section('bottombar')
    @include('components.bottombar')
@endsection

@section('sidebar')
    @include('components.sidebar')
@endsection

@section('card-title', 'My Reports')

@section('content')
    <div class="mb-3 row">
        <div class="col">
            <button id="filter-all" type="button" class="btn btn-outline-primary">All</button>
            <button id="filter-extraction" type="button" class="btn btn-outline-primary">Extraction</button>
            <button id="filter-icp" type="button" class="btn btn-outline-primary">ICP</button>
            <button id="filter-aas" type="button" class="btn btn-outline-primary">AAS</button>
            <button id="filter-ci" type="button" class="btn btn-outline-primary">CI</button>
            <button id="filter-oci" type="button" class="btn btn-outline-primary">OCI</button>
        </div>
    </div>
    <div class="mb-3 row">
        <div class="col">
            <table id="my-applications-table" class="table table-striped">
                <thead>
                    <tr>
                        <th class="text-center">Report ID</th>
                        <th class="text-center">Application ID</th>
                        <th class="text-center">Service</th>
                        <th class="text-center">Date Uploaded</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($serviceRequests as $request)
                        <tr>
                            <td>{{ $request->name }}</td>
                            <td>{{ $request->application->name }}</td>
                            <td>{{ $request->serviceType->name }}</td>
                            <td>{{ $request->application->created_at }}</td>
                            <td>
                                @if ($request->path)
                                    <button type="button" class="btn btn-outline-primary mb-1">View
                                        Report</button>
                                    <button type="button" class="btn btn-outline-primary">Print
                                        Report</button>
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
                        "targets": 4,
                        "orderable": false
                    },
                    {
                        "targets": [2, 3, 4],
                        "className": "text-center d-flexalign-items-center"
                    },
                    {
                        responsivePriority: 3,
                        "targets": 3
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
                table.column(2).search("").draw();
            });
            $('#filter-extraction').on('click', function() {
                table.column(2).search("Extraction").draw();
            });
            $('#filter-icp').on('click', function() {
                table.column(2).search("Element Analysis (ICP)").draw();
            });
            $('#filter-aas').on('click', function() {
                table.column(2).search("Element Analysis (AAS)").draw();
            });
            $('#filter-ci').on('click', function() {
                table.column(2).search("Chemical Isolation").draw();
            });
            $('#filter-oci').on('click', function() {
                table.column(2).search("Organic Compound Identification").draw();
            });
        });
    </script>
@endsection
