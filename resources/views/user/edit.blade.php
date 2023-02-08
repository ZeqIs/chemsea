@extends('components.layout')

@section('title', 'Manage Profile')

@section('bottombar')
    @include('components.bottombar')
@endsection

@section('sidebar')
    @include('components.sidebar')
@endsection

@section('card-title', 'Edit Profile')

@section('content')


    <form method="post" action="/users/profile/update">
        @csrf
        @method('PUT')
        <h4 class="row my-4 ps-3">Personal Details</h4>
        <div class="mb-3 row">
            <label for="personalTitle" class="col-lg-2 col-md-3 col-sm-12 col-form-label">Title</label>
            <div class="col-lg-10 col-md-9 col-sm-12">
                <select class="form-control" id="personalTitle" name="title">
                    <option value="Mr." {{ $user->title == 'Mr.' ? 'selected' : ' ' }}>Mr.</option>
                    <option value="Ms." {{ $user->title == 'Ms.' ? 'selected' : ' ' }}>Ms.</option>
                    <option value="Mrs." {{ $user->title == 'Mrs.' ? 'selected' : ' ' }}>Mrs.</option>
                </select>
                @error('title')
                    <p class="small text-danger">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="mb-3 row">
            <label for="personalFName" class="col-lg-2 col-md-3 col-sm-12 col-form-label">First
                Name</label>
            <div class="col-lg-10 col-md-9 col-sm-12">
                <input type="text" class="form-control" id="personalFName" name="first_name"
                    placeholder="Enter your first name" value="{{ $user->first_name }}">
                @error('first_name')
                    <p class="small text-danger">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="mb-3 row">
            <label for="personalLName" class="col-lg-2 col-md-3 col-sm-12 col-form-label">Last
                Name</label>
            <div class="col-lg-10 col-md-9 col-sm-12">
                <input type="text" class="form-control" id="personalLName" placeholder="Enter your last name"
                    value="{{ $user->last_name }}" name="last_name">
                @error('last_name')
                    <p class="small text-danger">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="mb-3 row">
            <label for="personalPhone" class="col-lg-2 col-md-3 col-sm-12 col-form-label">Phone
                Number</label>
            <div class="col-lg-10 col-md-9 col-sm-12">
                <input type="tel" class="form-control" id="personalPhone" placeholder="Enter your phone number"
                    name="phone_num" value="{{ $user->phone_num }}">
                @error('phone_num')
                    <p class="small text-danger">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <h4 class="row my-4 ps-3">Log In Details</h4>
        <div class="mb-3 row">
            <label for="loginEmail" class="col-lg-2 col-md-3 col-sm-12 col-form-label">E-mail</label>
            <div class="col-lg-10 col-md-9 col-sm-12">
                <input type="email" class="form-control" id="loginEmail" placeholder="Enter your e-mail address"
                    value="{{ $user->email }}" name="email">
                @error('email')
                    <p class="small text-danger">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="mb-3 row">
            <label for="loginPassword" class="col-lg-2 col-md-3 col-sm-12 col-form-label">Password</label>
            <div class="col-lg-10 col-md-9 col-sm-12">
                <input type="password" class="form-control" id="loginPassword" placeholder="Input your new password"
                    name="password">
                @error('password')
                    <p class="small text-danger">{{ $message }}</p>
                @enderror
                <p class="reg-note mt-2 mb-1">Password must consist of:</p>
                <ul>
                    <li class="reg-note">minimum 10 characters</li>
                    <li class="reg-note">combination of uppercase and lowercase letters</li>
                    <li class="reg-note">at least one number</li>
                    <li class="reg-note">at least one special characters</li>
                </ul>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="loginConfirmPassword" class="col-lg-2 col-md-3 col-sm-12 col-form-label">Confirm
                Password</label>
            <div class="col-lg-10 col-md-9 col-sm-12">
                <input type="password" class="form-control" id="loginConfirmPassword"
                    placeholder="Please confirm your password" name="password_confirmation">
                @error('password_confirmation')
                    <p class="small text-danger">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <h4 class="row my-4 ps-3">Company Details</h4>
        <div class="mb-3 row">
            <label for="companyList" class="col-lg-2 col-md-3 col-sm-12 col-form-label">Company</label>
            <div class="col-lg-10 col-md-9 col-sm-12">
                <select class="form-control" id="companyList">
                    <option value="" disabled>Select your affiliated company</option>
                    @foreach ($companies as $company)
                        <option value="{{ $company->id }}" {{ $company->id == $user->company_id ? 'selected' : '' }}>
                            {{ $company->name }}</option>
                    @endforeach
                </select>
                <p class="reg-note mt-2 mb-1">You may only change what company you are affiliated to. To
                    change the company detail, please send a request to admin@chemsea.com</p>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="companyName" class="col-lg-2 col-md-3 col-sm-12 col-form-label">Company
                Name</label>
            <div class="col-lg-10 col-md-9 col-sm-12">
                <input type="text" class="form-control" id="companyName"
                    value="{{ is_null($user->company_id) ? '' : $user->company->name }}" disabled readonly>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="companyAddress" class="col-lg-2 col-md-3 col-sm-12 col-form-label">Company
                Address</label>
            <div class="col-lg-10 col-md-9 col-sm-12">
                <textarea type="text" class="form-control" id="companyAddress" rows="5" disabled readonly>
                    {{ is_null($user->company_id) ? '' : $user->company->address }}
            </textarea>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="companyPostal" class="col-lg-2 col-md-3 col-sm-12 col-form-label">Postal
                Code</label>
            <div class="col-lg-4 col-md-4 col-sm-12">
                <input type="text" class="form-control"
                    id="companyPostal
                    value="{{ is_null($user->company_id) ? '' : $user->company->postal }}"
                    disabled readonly>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="companyCity" class="col-lg-2 col-md-3 col-sm-12 col-form-label">City</label>
            <div class="col-lg-4 col-md-4 col-sm-12">
                <input type="text" class="form-control"
                    id="companyCity
                    value="{{ is_null($user->company_id) ? '' : $user->company->city }}"
                    disabled readonly>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="companyState" class="col-lg-2 col-md-3 col-sm-12 col-form-label">State</label>
            <div class="col-lg-4 col-md-4 col-sm-12">
                <select class="form-control" id="companyState" disabled aria-readonly="true">
                    <option value="{{ is_null($user->company_id) ? '' : $user->company->state }}" selected>
                        {{ is_null($user->company_id) ? '' : $user->company->state }}</option>
                </select>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="companyEmail" class="col-lg-2 col-md-3 col-sm-12 col-form-label">Company
                E-mail</label>
            <div class="col-lg-10 col-md-9 col-sm-12">
                <input type="email" class="form-control" id="companyEmail"
                    value="{{ is_null($user->company_id) ? '' : $user->company->email }}" disabled readonly>
            </div>
        </div>
        <div class="mb-4 row">
            <label for="companyPhone" class="col-lg-2 col-md-3 col-sm-12 col-form-label">Company
                Phone No.</label>
            <div class="col-lg-10 col-md-9 col-sm-12">
                <input type="tel" class="form-control" id="companyPhone" pattern="01[0-9]{1}-[0-9]{8}"
                    value="{{ is_null($user->company_id) ? '' : $user->company->phone }}" disabled readonly>
            </div>
        </div>

        <div class="mb-3 px-sm-3 row">
            <a href="/users/profile"
                class="btn col-md-5 col-sm-12 btn-outline-primary mb-md-0 mb-3 ms-md-auto me-md-3">Cancel</a>
            <button type="submit" class="btn col-md-5 col-sm-12 btn-outline-primary me-md-auto">Submit
                Changes</button>
        </div>
    </form>
@endsection
