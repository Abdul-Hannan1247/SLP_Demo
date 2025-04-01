<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Http\Requests\PatientStoreRequest;
use Illuminate\Http\Request;
use App\Models\Patient;
use Illuminate\Container\Attributes\Storage;

class PatientController extends Controller
{
//--------------------------------------------------------------------------
//                   Index
//--------------------------------------------------------------------------
    public function index()
    {
        $patients = Patient::all();
        return view('patients.index', compact('patients'));
    }

//--------------------------------------------------------------------------
//                   Create
//--------------------------------------------------------------------------
    public function create()
    {
        return view('patients.create');
    }

//--------------------------------------------------------------------------
//                   Store
//--------------------------------------------------------------------------

    public function store(PatientStoreRequest $request)
{
    $validatedData = $request->validated();
   

    $patient = new Patient($validatedData);

    if ($request->hasFile('picture')) {
        $picturePath = $request->file('picture')->store('patients/patients_pics', 'public');
        $patient->picture = $picturePath;
    }
    // else {
    //     // Use a default picture
    //     $defaultPicturePath = 'patients_pic/pictures/avatar.png'; // Path to your default image in storage/app/public/patients/pictures
    //     if (Storage::disk('public')->exists($defaultPicturePath)) { //ensure that the default picture exists.
    //          $patient->picture = $defaultPicturePath;
    //     } else {
    //          $patient->picture = null; // if default image does not exists, set picture to null.
    //     }
    // }


    if ($request->hasFile('files')) {
        $filePaths = [];
        foreach ($request->file('files') as $file) {
            $filePath = $file->store('patients/files', 'public');
            $filePaths[] = $filePath;
        }
        $patient->files = $filePaths;
    }

    $patient->save();

    return redirect()->route('patients.index')->with('success', 'Patient created successfully.');
}

//--------------------------------------------------------------------------
//                   Edit
//--------------------------------------------------------------------------
    public function edit(Patient $patient)
    {
        return view('patients.edit', compact('patient'));
    }

//--------------------------------------------------------------------------
//                   Update
//--------------------------------------------------------------------------
    public function update(Request $request, Patient $patient)
    {
        $patient->update($request->all());
        return redirect()->route('patients.index');
    }


//--------------------------------------------------------------------------
//                   Destroy
//--------------------------------------------------------------------------
    public function destroy(Patient $patient)
    {
        $patient->delete(); // Soft delete
        // Or
        // $patient->forceDelete(); // Permanently delete
        return redirect()->route('patients.index')->with('success', 'Patient deleted successfully.');
    }
//--------------------------------------------------------------------------
//                   Show
//--------------------------------------------------------------------------
    public function show(Patient $patient)
    {
        return view('patients.show', compact('patient'));
    }
//--------------------------------------------------------------------------
//                   Trashed
//--------------------------------------------------------------------------
    public function trashed()
    {
       // $trashedPatients = Patient::onlyTrashed()->get();
        return view('patients.trashed');
        // , compact('trashedPatients'));
    }
    
//--------------------------------------------------------------------------
//                   Restore
//--------------------------------------------------------------------------
    public function restore($id)
    {
        $patient = Patient::withTrashed()->findOrFail($id);
        $patient->restore();
        return redirect()->route('patients.trashed')->with('success', 'Patient restored successfully.');
    }
//--------------------------------------------------------------------------
//                   ForeDelete
//--------------------------------------------------------------------------
   
    public function forceDelete($id)
    {
        $patient = Patient::withTrashed()->findOrFail($id);
        $patient->forceDelete();
        return redirect()->route('patients.trashed')->with('success', 'Patient permanently deleted.');
    }

}