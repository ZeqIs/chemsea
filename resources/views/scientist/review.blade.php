@extends('components.layout')

@section('title', 'Review Application')

@section('bottombar')
    @include('components.bottombar')
@endsection

@section('sidebar')
    @include('components.sidebar')
@endsection


@section('card-title')
    Application {{ $application->name }} Review <span class="badge bg-warning">Pending</span>
@endsection
@section('content')

    <h4 class="row my-4 ps-3">Application Details</h4>
    <div class="mb-3 row">
        <label for="sampleType" class="col-lg-2 col-md-3 col-sm-12 col-form-label">Sample
            Type</label>
        <div class="col-lg-10 col-md-9 col-sm-12">
            <div class="input-group">
                <select class="form-control" id="sampleType" name="sampleType" disabled>
                    <option {{ $application->sample_type == 'leaf' ? 'selected' : '' }}>Leaf</option>
                    <option {{ $application->sample_type == 'stem' ? 'selected' : '' }}>Stem</option>
                    <option {{ $application->sample_type == 'extract' ? 'selected' : '' }}>Extract</option>
                    <option {{ $application->sample_type != 'leaf' || 'stem' || 'extract' ? 'selected' : '' }}>Other
                    </option>
                </select>
                <input type="text" aria-label="otherType" id="otherType" class="form-control"
                    value="{{ $application->sample_type != 'leaf' || 'stem' || 'extract' ? $application->sample_type : '' }}"
                    name="sampleType" disabled>
            </div>
        </div>
    </div>
    <div class="mb-3 row">
        <label for="sampleName" class="col-lg-2 col-md-3 col-sm-12 col-form-label">Sample
            name</label>
        <div class="col-lg-10 col-md-9 col-sm-12">
            <input type="text" class="form-control" id="sampleName" name="sampleName"
                value="{{ $application->sample_name }}" disabled>
        </div>
    </div>
    <div class="mb-3 row">
        <label for="sampleSubmission" class="col-lg-2 col-md-3 col-sm-12 col-form-label">Sample
            Submission</label>
        <div class="col-lg-10 col-md-9 col-sm-12">
            <input type="text" class="form-control" id="sampleSubmission" name="sampleSubmission"
                value="{{ $application->sample_submission }}" disabled>
        </div>
    </div>

    @if ($application->sample_submission == 'In-person')
        <form method="POST" action="/applications/{{ $application->id }}/update/appointment" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3 row" id="appointment_dateDiv">
                <label for="appointment_date" class="col-lg-2 col-md-3 col-sm-12 col-form-label">Consultation Date</label>
                <div class="col-lg-10 col-md-9 col-sm-12">
                    <input type="date" class="form-control" id="appointment_date" name="appointment_date"
                        value="{{ $application->appointment_date }}">
                    @error('appointment_date')
                        <p class="small text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>
    @endif
    <h4 class="row my-4 ps-3">Service Details</h4>
    <div class="mb-3 row">
        <label for="services" class="col-lg-2 col-md-3 col-sm-12 col-form-label">Services</label>
        <div class="col-lg-10 col-md-9 col-sm-12">
            <ul id="requestedServices">
                @foreach ($application->serviceRequest as $request)
                    <li value="{{ $request->serviceType->id }}">{{ $request->serviceType->name }}</li>
                @endforeach
            </ul>
        </div>
    </div>
    @foreach ($application->serviceRequest as $request)
        <div class="mb-3 row">
            <label for="{{ $request->serviceType->name }}Details"
                class="col-lg-2 col-md-3 col-sm-12 col-form-label">{{ $request->serviceType->name }}
                Details</label>
            <div class="col-lg-10 col-md-9 col-sm-12">
                <textarea type="text" class="form-control" placeholder="Please describe your request in detail..." rows="5"
                    disabled>{{ $request->detail }}</textarea>
            </div>
        </div>
    @endforeach

    @if ($application->sample_submission == 'Delivery')
        <form method="POST" action="/applications/{{ $application->id }}/update/appointment"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
    @endif
    <div class="mb-3 px-sm-3 row">
        <button type="submit" class="btn col-md-5 col-sm-12 btn-outline-danger mb-md-0 mb-3 ms-md-auto me-md-3"
            name="status" value="Rejected">Reject</button>
        <button type="submit" class="btn col-md-5 col-sm-12 btn-outline-success me-md-auto" name="status"
            value="In progress">Accept</button>
    </div>
    </form>
@endsection

@section('script')
    <script>
        $(function() {
            if ($("#sampleSubmission").attr("value") == "In-person") {
                $("#appointment_date").removeAttr("disabled").attr("required", "required");
                $("#appointment_dateDiv").removeAttr("hidden");
            }
        })
    </script>
    <script>
        $(function() {
            var requested = [];
            $("#requestedServices li").each(function() {
                requested.push($(this).attr("value"))
            })
            requested.forEach(element => {
                $("#" + element + "DetailsDiv").removeAttr("hidden");
            });
        })
    </script>
@endsection
