<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Company;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function login()
    {
        return view('user.login');
    }

    public function create()
    {
        return view('user.register', ['companies' => Company::all()]);
    }

    public function store(Request $request)
    {
        $userFields = $request->validate([
            'title' => 'required',
            'first_name' => ['required', 'min:4'],
            'last_name' => ['required', 'min:4'],
            'phone_num' => 'required',
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'string', 'confirmed', 'min:8', 'regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/',],
            'companyid' => 'nullable',
        ]);

        $companyNotExist = $request->input('company_not_exist');
        if ($companyNotExist) {
            $companyFields = $request->validate([
                'company_name' => 'required',
                'company_address' => 'required',
                'company_postal' => 'required',
                'company_city' => 'required',
                'company_state' => 'required',
                'company_email' => ['required', 'email', Rule::unique('companies', 'email')],
                'company_phone' => 'required'
            ]);

            $company = Company::create([
                'name' => $companyFields['company_name'],
                'address' => $companyFields['company_address'],
                'postal' => $companyFields['company_postal'],
                'city' => $companyFields['company_city'],
                'state' => $companyFields['company_state'],
                'email' => $companyFields['company_email'],
                'phone' => $companyFields['company_phone']
            ]);

            $userFields['companyid'] = $company->id;
        }

        $userFields['password'] = bcrypt($userFields['password']);

        $user = User::create($userFields);
        $user->update(['company_id' => $userFields['companyid']]);

        auth()->login($user);

        return redirect('/applications/index')->with([
            'message' => 'User created successfully! Welcome to CHEMSEA!',
            'type' => 'success'
        ]);
    }

    public function logout(Request $request)
    {

        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with([
            'message' => 'You have been logged out!',
            'type' => 'info'
        ]);
    }

    public function authenticate(Request $request)
    {

        $userFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required',
        ]);

        if (auth()->attempt($userFields)) {
            $request->session()->regenerate();
            return redirect('/applications/index')->with([
                'message' => 'Logged in successfully! Welcome to CHEMSEA',
                'type' => 'info'
            ]);
        }
        return back()->with([
            'message' => 'Invalid credentials. Please ensure you use the correct email and password.',
            'type' => 'danger'
        ]);
    }

    public function show()
    {
        return view('user.profile', ['user' => auth()->user()]);
    }

    public function edit()
    {
        return view('user.edit', ['user' => auth()->user(), 'companies' => Company::all()]);
    }

    public function update(Request $request)
    {
        $formFields = $request->validate([
            'title',
            'first_name',
            'last_name',
            'phone_num',
            'email',
            'password' => ['current_password', 'confirmed'],
            'company_id'
        ]);

        $updated = [];
        $user = User::where('id', auth()->user());
        foreach ($formFields as $field => $value) {
            if ($user->{$field} != $value) {
                $updated[$field] = $value;
            }
        }

        if (!empty($updated)) {
            try {
                $user->update($updated);
                return redirect('/users/profile')->with([
                    'message' => 'Profile updated successfully!',
                    'type' => 'success'
                ]);
            } catch (QueryException $e) {
                return back()->with([
                    'message' => 'Failed to update profile. Please try again later',
                    'type' => 'danger'
                ]);
            }
        } else {
            return back()->with([
                'message' => 'No changes were made',
                'type' => 'danger'
            ]);
        }
    }
}
