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
public function index(Request $request)
    {
        $search = $request->search;
        $sort = $request->sort;

        $patients = Patient::query();

        if ($search) {
            $patients->where(function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('gender', 'like', "%{$search}%")
                    ->orWhere('date_of_birth', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('emergency_contact', 'like', "%{$search}%")
                    ->orWhere('address', 'like', "%{$search}%")
                    ->orWhere('referral', 'like', "%{$search}%");
            });
        }

        if ($sort) {
            $patients->orderBy('date_of_birth', $sort);
        } else {
            $patients->orderBy('created_at', 'desc'); // Show latest entries first
        }

        $patients = $patients->paginate(10);

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
        // dd($picturePath);
        $patient->picture = $picturePath;
    }
  
   



    if ($request->hasFile('files')) {
        $filePaths = [];
        foreach ($request->file('files') as $file) {
            $filePath = $file->store('patients/files', 'public');
            $filePaths[] = $filePath;
        }
        $patient->files = $filePaths;
    }

    $patient->save();

    return redirect()->route('patients.create')->with('success', 'Patient created successfully!');
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
//                   Destroy   -> Softdelete
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
public function trashed(Request $request)
{
    $search = $request->search;
    $sort = $request->sort;

    $trashedPatients = Patient::onlyTrashed();

    if ($search) {
        $trashedPatients->where(function ($query) use ($search) {
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('gender', 'like', "%{$search}%")
                ->orWhere('date_of_birth', 'like', "%{$search}%")
                ->orWhere('phone', 'like', "%{$search}%")
                ->orWhere('emergency_contact', 'like', "%{$search}%")
                ->orWhere('address', 'like', "%{$search}%")
                ->orWhere('referral', 'like', "%{$search}%");
        });
    }

    if ($sort) {
        $trashedPatients->orderBy('date_of_birth', $sort);
    } else {
        $trashedPatients->orderBy('deleted_at', 'desc'); // Sort by deletion date
    }

    $trashedPatients = $trashedPatients->paginate(10);

    if ($request->ajax()) {
        return view('admin.patients.trashed-table-rows', compact('trashedPatients'));
    }

    return view('patients.trashed', compact('trashedPatients'));
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