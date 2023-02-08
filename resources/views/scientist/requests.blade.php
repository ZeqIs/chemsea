@extends('components.layout')

@section('title', 'Service Requests')

@section('bottombar')
    @include('components.bottombar')
@endsection

@section('sidebar')
    @include('components.sidebar')
@endsection

@section('card-title', 'Service Requests')

@section('content')
    <div class="mb-3 row">
        <div class="col">
            <button id="filter-all" type="button" class="btn btn-outline-primary">All</button>
            <button id="filter-pending" type="button" class="btn btn-outline-primary">Pending
                Report</button>
            <button id="filter-uploaded" type="button" class="btn btn-outline-primary">Report
                Uploaded</button>
        </div>
    </div>
    <div class="mb-3 row">
        <div class="col">
            <table id="my-applications-table" class="table table-striped">
                <thead>
                    <tr>
                        <th class="text-center">Application ID</th>
                        <th class="text-center">Service</th>
                        <th class="text-center">Report ID</th>
                        <th class="text-center">Date Uploaded</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($serviceRequests as $request)
                        <tr>
                            <td>{{ $request->application->name }}</td>
                            <td>{{ $request->serviceType->name }}</td>
                            <td>{{ $request->name }}</td>
                            <td>{{ $request->upload_date }}</td>
                            <td>
                                @if ($request->path)
                                    <div class="mb-3">
                                        <form id="upload" action="/requests/{{ $request->id }}/upload" method="post"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <input type="file" name="pdf_file">
                                        </form>
                                    </div>
                                    <a href="/requests/{{ $request->id }}/view" class="btn btn-outline-primary bt-sm"><i
                                            class="bi bi-book"></i></a>
                                    <button form="upload" class="btn btn-outline-primary bt-sm"><i
                                            class="bi bi-pencil-square"></i></button>
                                    <a href="/requests/{{ $request->id }}/download"
                                        class="btn btn-outline-primary bt-sm"><i class="bi bi-download"></i></a>
                                @else
                                    <form action="/requests/{{ $request->id }}/upload" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <input type="file" name="pdf_file">
                                        <button type="submit" class="btn btn-outline-primary my-2">Upload
                                            Report</button>
                                    </form>
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
                        responsivePriority: 5,
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
                        responsivePriority: 3,
                        "targets": 1
                    }
                ]
            });
            $('#filter-all').on('click', function() {
                table.column(3).search("").draw();
            });
            $('#filter-pending').on('click', function() {
                table.column(3).search("N/A").draw();
            });
            $('#filter-uploaded').on('click', function() {
                table.column(3).search("^((?!N/A).)*$", true, false, true).draw();
            });
        });
    </script>
@endsection
