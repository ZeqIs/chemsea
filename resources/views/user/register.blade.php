@extends('components.layout')

@section('title', 'Register')

@section('bottombar')
    @include('components.bottombar')
@endsection

@section('card-title', 'Registration Form')

@section('content')
    <form method="POST" action="/users" enctype="multipart/form-data">
        @csrf
        <h4 class="row my-4 ps-3">Personal Details</h4>
        <div class="mb-3 row">
            <label for="title" class="col-lg-2 col-md-3 col-sm-12 col-form-label">Title</label>
            <div class="col-lg-10 col-md-9 col-sm-12">
                <select class="form-control" id="title" name="title">
                    <option value="" disabled>Select your title</option>
                    <option value="Mr.">Mr.</option>
                    <option value="Ms.">Ms.</option>
                    <option value="Mrs.">Mrs.</option>
                </select>
                @error('title')
                    <p class="small text-danger">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="mb-3 row">
            <label for="first_name" class="col-lg-2 col-md-3 col-sm-12 col-form-label">First
                Name</label>
            <div class="col-lg-10 col-md-9 col-sm-12">
                <input type="text" class="form-control" id="first_name" name="first_name"
                    placeholder="Enter your first name" value="{{ old('first_name') }}">
                @error('first_name')
                    <p class="small text-danger">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="mb-3 row">
            <label for="last_name" class="col-lg-2 col-md-3 col-sm-12 col-form-label">Last
                Name</label>
            <div class="col-lg-10 col-md-9 col-sm-12">
                <input type="text" class="form-control" id="last_name" name="last_name"
                    placeholder="Enter your last name" value="{{ old('last_name') }}">
                @error('last_name')
                    <p class="small text-danger">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="mb-3 row">
            <label for="phone_num" class="col-lg-2 col-md-3 col-sm-12 col-form-label">Phone
                Number</label>
            <div class="col-lg-10 col-md-9 col-sm-12">
                <input type="tel" class="form-control" id="phone_num" name="phone_num"
                    placeholder="Enter your phone number" value="{{ old('phone_num') }}">
                @error('phone_num')
                    <p class="small text-danger">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <h4 class="row my-4 ps-3">Log In Details</h4>
        <div class="mb-3 row">
            <label for="email" class="col-lg-2 col-md-3 col-sm-12 col-form-label">E-mail</label>
            <div class="col-lg-10 col-md-9 col-sm-12">
                <input type="email" class="form-control" id="email" name="email"
                    placeholder="Enter your e-mail address" value="{{ old('email') }}">
                @error('email')
                    <p class="small text-danger">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="mb-3 row">
            <label for="password" class="col-lg-2 col-md-3 col-sm-12 col-form-label">Password</label>
            <div class="col-lg-10 col-md-9 col-sm-12">
                <input type="password" class="form-control" id="password" name="password"
                    placeholder="Please create a password" value="{{ old('password') }}">
                @error('password')
                    <p class="small text-danger">{{ $message }}</p>
                @enderror
                <p class="reg-note mt-2 mb-1">Password must consist of:</p>
                <ul>
                    <li class="reg-note">minimum 8 characters</li>
                    <li class="reg-note">combination of uppercase and lowercase letters</li>
                    <li class="reg-note">at least one number</li>
                    <li class="reg-note">at least one special characters</li>
                </ul>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="password_confirmation" class="col-lg-2 col-md-3 col-sm-12 col-form-label">Confirm Password</label>
            <div class="col-lg-10 col-md-9 col-sm-12">
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                    placeholder="Please re-enter your password" value="{{ old('password_confirmation') }}">
                @error('password_confirmation')
                    <p class="small text-danger">{{ $message }}</p>
                @enderror
                <p class="reg-note mt-2">If registering as a scientist, please notify system admin at
                    admin@chemsea.com for verification.</p>
            </div>
        </div>
        <h4 class="row my-4 ps-3">Company Details</h4>
        <div class="mb-3 row">
            <label for="companyid" class="col-lg-2 col-md-3 col-sm-12 col-form-label">Company</label>
            <div class="col-lg-10 col-md-9 col-sm-12">
                <select class="form-control" name="companyid" id="companyid">
                    <option value="">Select your affiliated company</option>
                    @foreach ($companies as $company)
                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                    @endforeach
                </select>
                @error('companyid')
                    <p class="small text-danger">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="mb-3 row">
            <div class="col-lg-2 col-md-3"></div>
            <div class="col-lg-10 col-md-9 col-sm-12">
                <input class="form-check-input" type="checkbox" name="companynot_exist" id="companynot_exist">
                <label class="form-check-label" for="companynot_exist">
                    I cannot find my company in the list
                </label>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="company_name" class="col-lg-2 col-md-3 col-sm-12 col-form-label">Company
                Name</label>
            <div class="col-lg-10 col-md-9 col-sm-12">
                <input type="text" class="form-control" id="company_name" name="company_name"
                    placeholder="Enter the company name" value="{{ old('company_name') }}" disabled>
            </div>
            @error('company_name')
                <p class="small text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-3 row">
            <label for="company_address" class="col-lg-2 col-md-3 col-sm-12 col-form-label">Company
                Address</label>
            <div class="col-lg-10 col-md-9 col-sm-12">
                <textarea type="text" class="form-control" id="company_address" name="company_address"
                    placeholder="Enter the company address" rows="5" value="{{ old('company_address') }}" disabled></textarea>
            </div>
            @error('company_address')
                <p class="small text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-3 row">
            <label for="company_postal" class="col-lg-2 col-md-3 col-sm-12 col-form-label">Postal
                Code</label>
            <div class="col-lg-4 col-md-4 col-sm-12">
                <input type="text" class="form-control" id="company_postal" name="company_postal"
                    placeholder="Enter postal code" value="{{ old('company_postal') }}" disabled>
            </div>
            @error('company_postal')
                <p class="small text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-3 row">
            <label for="company_city" class="col-lg-2 col-md-3 col-sm-12 col-form-label">City</label>
            <div class="col-lg-4 col-md-4 col-sm-12">
                <input type="text" class="form-control" id="company_city" name="company_city"
                    placeholder="Enter city" value="{{ old('company_city') }}" disabled>
            </div>
            @error('company_city')
                <p class="small text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-3 row">
            <label for="company_state" class="col-lg-2 col-md-3 col-sm-12 col-form-label">State</label>
            <div class="col-lg-4 col-md-4 col-sm-12">
                <select class="form-control" id="company_state" name="company_state" disabled>
                    <option value="" disabled selected>Select state</option>
                    <option value="Perak">Perak</option>
                    <option value="Perlis">Perlis</option>
                    <option value="Sabah">Sabah</option>
                    <option value="W.P. Kuala Lumpur">W.P. Kuala Lumpur</option>
                </select>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="company_email" class="col-lg-2 col-md-3 col-sm-12 col-form-label">Company
                E-mail</label>
            <div class="col-lg-10 col-md-9 col-sm-12">
                <input type="email" class="form-control" id="company_email" name="company_email"
                    placeholder="Enter company e-mail address" value="{{ old('company_email') }}" disabled>
            </div>
        </div>
        <div class="mb-4 row">
            <label for="company_phone" class="col-lg-2 col-md-3 col-sm-12 col-form-label">Company
                Phone No.</label>
            <div class="col-lg-10 col-md-9 col-sm-12">
                <input type="text" class="form-control" id="company_phone" name="company_phone"
                    placeholder="Enter company phone number" value="{{ old('company_phone') }}" disabled>
            </div>
        </div>
        <div class="mb-3 px-sm-3 row">
            <button type="reset" class="btn col-md-5 col-sm-12 btn-outline-danger mb-md-0 mb-3 ms-md-auto me-md-3">Reset
                All</button>
            <button type="submit" class="btn col-md-5 col-sm-12 btn-outline-primary me-md-auto">Create
                Account</button>
        </div>
    </form>
@endsection

@section('script')
    <script>
        var checkbox = document.getElementById("companynot_exist");

        checkbox.addEventListener("change", function() {
            var inputs = document.querySelectorAll(
                "input[name^='company_'], select[name^='company_'], textarea[name^='company_']");
            inputs.forEach(function(input) {
                input.disabled = !checkbox.checked;
            });
        });
    </script>
@endsection
