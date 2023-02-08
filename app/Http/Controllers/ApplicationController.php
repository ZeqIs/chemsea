<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\ServiceRequest;
use App\Models\ServiceType;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function index()
    {
        return view('applications.index', ['applications' => auth()->user()->applications->all()]);
    }

    public function show(Application $application)
    {
        return view('applications.show', ['application' => $application]);
    }

    public function scientistIndex()
    {
        return view('scientist.applications', ['applications' => Application::all()]);
    }

    public function create()
    {
        return view('applications.create', ['services' => ServiceType::all()]);
    }

    public function review(Application $application)
    {
        return view('scientist.review', ['application' => $application]);
    }

    public function store(Request $request)
    {
        $applicationFields = $request->validate([
            'sample_type' => ['required', 'in:leaf,stem,extract,other'],
            'other_type' => 'required_if:sample_type,other',
            'sample_name' => 'required',
            'sample_submission' => 'required',
        ], [
            'other_type.required_if' => 'Please specify sample type',
        ]);

        $request->validate([
            'service.*' => 'required_without_all:other_field'
        ], [
            'service.*.required' => 'At least one checkbox must be selected',
            'detail.*.required_if' => 'This detail field is required.',
        ]);

        if ($applicationFields['sample_type'] == 'other')
            $applicationFields['sample_type'] = $applicationFields['other_type'];

        $applicationFields['applicant_id'] = auth()->id();
        $applicationFields['created_at'] = date("Ymd");

        $application = Application::create($applicationFields);

        $application->update([
            $application->name = date("Ymd")  . "_" . $application->applicant_id  . "_" . implode(explode(" ", $application->sample_name)) . "_" . $application->id,
        ]);

        $services = $request->input('service');
        $details = $request->input('detail');

        foreach ($services as $id => $value) {
            if ($value) {
                $type = ServiceType::where('id', $value)->first();
                ServiceRequest::create([
                    'application_id' => $application->id,
                    'service_type_id' => $value,
                    'name' => $application->name . "_" . $type->abbr,
                    'detail' => $details[$id],
                ]);
            }
        }

        return redirect('/applications/index')->with([
            'message' => 'Application created successfully!',
            'type' => 'success'
        ]);
    }

    public function updateTracking(Request $request, Application $application)
    {
        $formfields = $request->validate([
            'tracking_num' => 'required'
        ]);

        $application->update($formfields);

        return back()->with([
            'message' => 'Updated tracking number successfully!',
            'type' => 'success'
        ]);
    }

    public function updateAppointment(Request $request, Application $application)
    {


        if ($application->sample_submission == 'In-person') {
            $request->validate([
                'appointment_date' => 'required'
            ]);
        }

        $formfields = $request->all();

        $formfields['status'] = $request->input('status');

        if ($application->sample_submission == 'In-person') {
            $application->update([
                'appointment_date' => $formfields['appointment_date'],
                'status' => $formfields['status']
            ]);
        } else {
            $application->update([
                'status' => $formfields['status'],
                'scientist_id' => auth()->user()->id,
            ]);
        }


        return redirect('/applications/' . $application->id)->with([
            'message' => 'Application review completed successfully!',
            'type' => 'success'
        ]);
    }
}
