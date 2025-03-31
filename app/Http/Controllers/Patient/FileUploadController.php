<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use App\Models\FileUpload; // Make sure you have this model

class FileUploadController extends Controller
{
    public function create()
    {
        $patients = Patient::all();
        return view('patients.patient_files.create', compact('patients'));
    }
    

    public function uploadPatientFile(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:10240',
            'patient_id' => 'required|exists:patients,id',
        ]);
    
        $filePath = $request->file('file')->store('/private/patient_files');
        //   dd($request->all());
        FileUpload::create([
            'patient_id' => $request->input('patient_id'),
            'file_path' => $filePath,
           // 'uploaded_by' => $request->input(Auth::id()),
        ]);
    
        return redirect()->back()->with('success', 'File uploaded successfully.');
    }

    public function downloadPatientFile($recordId)
{
    $record = FileUpload::findOrFail($recordId);

    if (!Auth::user()->can('download', $record)) {
        abort(403, 'Unauthorized.');
    }

    $filePath = $record->file_path;

    if (Storage::exists($filePath)) {
        return Response::download(storage_path('app/' . $filePath), $record->original_filename);
    }

    abort(404, 'File not found.');
}

}
