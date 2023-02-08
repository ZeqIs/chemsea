@extends('components.layout')

@section('title', 'Manage Profile')

@section('bottombar')
    @include('components.bottombar')
@endsection

@section('sidebar')
    @include('components.sidebar')
@endsection

@section('card-title', 'New Application')

@section('content')

    <h4 class="row my-4 ps-3">Application Details</h4>
    <form method="POST" action="/applications/store" enctype="multipart/form-data">
        @csrf
        <div class="mb-3 row">
            <label for="sample_type" class="col-lg-2 col-md-3 col-sm-12 col-form-label">Sample
                Type</label>
            <div class="col-lg-10 col-md-9 col-sm-12">
                <div class="input-group">
                    <select class="form-control" id="sample_type" name="sample_type">
                        <option value="" disabled>Select Select sample type</option>
                        <option value="leaf" selected>Leaf</option>
                        <option value="stem">Stem</option>
                        <option value="extract">Extract</option>
                        <option value="other">Other</option>
                    </select>
                    <input type="text" aria-label="other_type" id="other_type" class="form-control" name="other_type"
                        disabled>
                </div>
                @error('sample_type')
                    <p class="small text-danger">{{ $message }}</p>
                @enderror
                @error('other_type')
                    <p class="small text-danger">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="mb-3 row">
            <label for="sample_name" class="col-lg-2 col-md-3 col-sm-12 col-form-label">Sample
                name</label>
            <div class="col-lg-10 col-md-9 col-sm-12">
                <input type="text" class="form-control" id="sample_name" name="sample_name"
                    placeholder="Enter sample name">
                @error('sample_name')
                    <p class="small text-danger">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="mb-3 row">
            <label for="sample_submission" class="col-lg-2 col-md-3 col-sm-12 col-form-label">Sample
                Submission</label>
            <div class="col-lg-10 col-md-9 col-sm-12">
                <input class="form-check-input" type="radio" name="sample_submission" value="In-person"
                    id="sampleSubmission1">
                <label class="form-check-label" for="sampleSubmission1">
                    In-person</label>
                <input class="form-check-input" type="radio" name="sample_submission" value="Delivery"
                    id="sampleSubmission2">
                <label class="form-check-label" for="sampleSubmission2">
                    Delivery</label>
                @error('sample_submission')
                    <p class="small text-danger">{{ $message }}</p>
                @enderror
                <p class="reg-note mt-2 mb-1">If opt for delivery, you are required to:</p>
                <ul>
                    <li class="reg-note">provide details for each service(s)</li>
                    <li class="reg-note">provide tracking number once application is accepted</li>
                </ul>
            </div>
        </div>

        <h4 class="row my-4 ps-3">Service Details</h4>
        <div class="mb-3 row">
            <label for="services" class="col-lg-2 col-md-3 col-sm-12 col-form-label">Services</label>
            <div class="col-lg-10 col-md-9 col-sm-12">
                @foreach ($services as $service)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="{{ $service->id }}" name="service[]"
                            class="serviceChkbx" id="service{{ $service->id }}">
                        <label class="form-check-label" for="service{{ $service->id }}">
                            {{ $service->name }}
                        </label>
                        @error('service' . $service->id)
                            <p class="small text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                @endforeach
            </div>
        </div>
        @foreach ($services as $service)
            <div class="mb-3 row">
                <label for="detail{{ $service->id }}"
                    class="col-lg-2 col-md-3 col-sm-12 col-form-label">{{ $service->name }}
                    Details</label>
                <div class="col-lg-10 col-md-9 col-sm-12">
                    <textarea type="text" class="form-control" name="detail[]" id="detail{{ $service->id }}"
                        placeholder="Please describe your request in detail..." rows="5" disabled></textarea>
                </div>
                @error('detail' . $service->id)
                    <p class="small text-danger">{{ $message }}</p>
                @enderror
            </div>
        @endforeach

        <div class="mb-3 px-sm-3 row">
            <button type="reset" class="btn col-md-5 col-sm-12 btn-outline-danger mb-md-0 mb-3 ms-md-auto me-md-3">Reset
                All</button>
            <button type="submit" class="btn col-md-5 col-sm-12 btn-outline-primary me-md-auto">Submit
                Application</button>
        </div>
    </form>
@endsection

@section('script')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var checkboxes = document.querySelectorAll("input[type='checkbox']");
            checkboxes.forEach(function(checkbox) {
                checkbox.addEventListener("change", function() {
                    var textareaId = 'detail' + this.value;
                    var textarea = document.getElementById(textareaId);
                    if (this.checked) {
                        textarea.disabled = false;
                    } else {
                        textarea.disabled = true;
                    }
                });
            });
        });
        $(function() {
            $("#sample_type").change(function() {
                if ($(this).val() == 'other') {
                    $("#other_type").removeAttr("disabled").attr("placeholder", "Enter sample type");
                } else {
                    $("#other_type").attr("disabled", "disabled").removeAttr("placeholder").val('');
                }

            }).trigger('change');
        });
    </script>
@endsection
