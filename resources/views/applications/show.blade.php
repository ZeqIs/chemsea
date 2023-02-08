@extends('components.layout')

@section('title', 'Application Details')

@section('bottombar')
    @include('components.bottombar')
@endsection

@section('sidebar')
    @include('components.sidebar')
@endsection

@section('card-title')
    Application {{ $application->name }}
    @if ($application->status == 'Complete')
        <span class="badge bg-success">Complete</span>
    @elseif($application->status == 'In progress')
        <span class="badge bg-warning">In Progress</span>
    @elseif($application->status == 'Pending')
        <span class="badge bg-warning">Pending</span>
    @else
        <span class="badge bg-danger">Rejected</span>
    @endif
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
    @if ($application->status == 'In progress' && $application->sample_submission == 'In-person')
        <div class="mb-3 row" id="consultationDateDiv">
            <label for="consultationDate" class="col-lg-2 col-md-3 col-sm-12 col-form-label">Consultation Date</label>
            <div class="col-lg-10 col-md-9 col-sm-12">
                <input type="date" class="form-control" id="consultationDate" name="consultationDate"
                    value="{{ $application->appointment_date }}" disabled>
            </div>
        </div>
    @elseif(
        ($application->status == 'In progress' || $application->status == 'Complete') &&
            $application->sample_submission == 'Delivery')
        <form method="POST" action="/applications/{{ $application->id }}/update/tracking" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3 row" id="trackingNumberDiv">
                <label for="tracking_num" class="col-lg-2 col-md-3 col-sm-12 col-form-label">Tracking
                    Number</label>
                <div class="col-lg-10 col-md-9 col-sm-12">
                    <input type="text" class="form-control" name="tracking_num" value="{{ $application->tracking_num }}"
                        {{ $application->applicant_id == auth()->user()->id ? '' : 'disabled' }}>
                    @error('tracking_num')
                        <p class="small text-danger">{{ $message }}</p>
                    @enderror
                    @if ($application->applicant_id == auth()->user()->id)
                        <button type="submit" class="btn btn-outline-primary mt-1">Submit Tracking Number</button>
                    @endif
                </div>
            </div>

        </form>

        <h4 class="row my-4 ps-3">Scientist Details</h4>
        <div class="mb-3 row">
            <label for="scientistName" class="col-lg-2 col-md-3 col-sm-12 col-form-label">Name</label>
            <div class="col-lg-10 col-md-9 col-sm-12">
                <input type="text" class="form-control" id="scientistName" name="scientistName"
                    value="{{ $name = $application->scientist->first_name . ' ' . $application->scientist->last_name }}"
                    disabled>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="scientistPhone" class="col-lg-2 col-md-3 col-sm-12 col-form-label">Phone
                Number</label>
            <div class="col-lg-10 col-md-9 col-sm-12">
                <input type="tel" class="form-control" id="scientistPhone" name="scientistPhone"
                    value="{{ $application->scientist->phone_num }}" disabled>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="E-mail" class="col-lg-2 col-md-3 col-sm-12 col-form-label">E-mail</label>
            <div class="col-lg-10 col-md-9 col-sm-12">
                <input type="email" class="form-control" id="E-mail" name="E-mail"
                    value="{{ $application->scientist->email }}" disabled>
            </div>
        </div>
    @endif

    <h4 class="row my-4 ps-3">Service Details</h4>
    <div class="mb-3 row">
        <label for="services" class="col-lg-2 col-md-3 col-sm-12 col-form-label">Services</label>
        <div class="col-lg-10 col-md-9 col-sm-12">
            <ul>
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
        @if ($application->status == 'In progress' || $application->status == 'Complete')
            <div class="mb-3 row">
                <label for="{{ $request->serviceType->name }}Status"
                    class="col-lg-2 col-md-3 col-sm-12 col-form-label">Status</label>
                <div class="col-lg-10 col-md-9 col-sm-12">
                    @if ($request->status == 'Complete')
                        <span class="badge bg-success">Complete</span>
                    @elseif($request->status == 'In progress')
                        <span class="badge bg-warning">In Progress</span>
                    @endif
                </div>
            </div>
            @if ($request->status == 'Complete')
                <div class="mb-3 row">
                    <div class="mx-auto">
                        <button type="button" class="btn btn-outline-primary col-12">View Report</button>
                    </div>
                </div>
            @endif
        @endif
    @endforeach

    <div class="mb-3 row">
        <div class="mx-auto">
            <button type="button" class="btn col-12 btn-outline-primary me-md-auto">Print
                Application</button>
        </div>
    </div>

    </div>
@endsection
