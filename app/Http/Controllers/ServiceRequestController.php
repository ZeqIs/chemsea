<?php

namespace App\Http\Controllers;

use App\Models\ServiceRequest;
use Exception;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class ServiceRequestController extends Controller
{
    public function index()
    {
        return view('requests.index', ['serviceRequests' => auth()->user()->serviceRequests->all()]);
    }

    public function scientistIndex()
    {
        return view('scientist.requests', ['serviceRequests' => ServiceRequest::all()]);
    }

    public function upload(Request $request, ServiceRequest $serviceRequest)
    {
        $request->validate([
            'pdf_file' => ['mimes:pdf', 'max:1024']
        ]);

        try {
            if (!$request->hasFile('pdf_file')) {
                throw new Exception();
            }
            $file = $request->file('pdf_file');
            $fileName = $serviceRequest->name . '.pdf';
            $file->storeAs('assets', $fileName);
            $serviceRequest->path = $fileName;
            try {
                $serviceRequest->save();
                return back()->with([
                    'message' => 'File uploaded successfully',
                    'type' => 'success'
                ]);
            } catch (FileException $e) {
                // Perform other actions you want to do with the uploaded file
                return back()->with([
                    'message' => 'Failed to upload file. Please try again later.',
                    'type' => 'danger'
                ]);
            }
        } catch (Exception $e) {
            // Perform other actions you want to do with the uploaded file
            return back()->with([
                'message' => 'No file uploaded',
                'type' => 'danger'
            ]);
        }
    }

    public function view(ServiceRequest $serviceRequest)
    {
        $path = storage_path('app\\assets\\' . $serviceRequest->path);
        try {
            if (!file_exists($path)) {
                throw new Exception();
            }
        } catch (Exception) {
            return back()->with([
                'message' => 'File don\'t exist. Please report to scientist or system admin.',
                'type' => 'danger'
            ]);
        }
        try {
            return response()->file($path);
        } catch (FileNotFoundException) {
            return back()->with([
                'message' => 'We encountered an error retrieving the file. Try again later.',
                'type' => 'danger'
            ]);
        }
    }

    public function download(ServiceRequest $serviceRequest)
    {
        $path = storage_path('app\\assets\\' . $serviceRequest->path);
        try {
            if (!file_exists($path)) {
                throw new Exception();
            }
        } catch (Exception) {
            return back()->with([
                'message' => 'File don\'t exist. Please report to scientist or system admin.',
                'type' => 'danger'
            ]);
        }
        try {
            return response()->download($path);
        } catch (FileNotFoundException) {
            return back()->with([
                'message' => 'We encountered an error retrieving the file. Try again later.',
                'type' => 'danger'
            ]);
        }
    }
}
