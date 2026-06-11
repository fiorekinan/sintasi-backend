<?php

namespace App\Http\Controllers\Api;

use App\Models\Patient;
use Illuminate\Support\Facades\Crypt;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|digits:16',
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'address' => 'required|string',
            'birth_date' => 'required|date',
        ]);
    
        $lastPatient = Patient::latest()->first();
    
        $nextNumber = $lastPatient
            ? ((int) substr($lastPatient->medical_record_number, 2)) + 1
            : 1;
    
        $medicalRecordNumber = 'RM' . str_pad(
            $nextNumber,
            4,
            '0',
            STR_PAD_LEFT
        );
    
        $patient = Patient::create([
            'medical_record_number' => $medicalRecordNumber,
            'nik' => Crypt::encryptString($request->nik),
            'name' => $request->name,
            'email' => Crypt::encryptString($request->email),
            'address' => $request->address,
            'birth_date' => $request->birth_date,
        ]);
    
        return response()->json([
            'message' => 'Patient created successfully',
            'data' => $patient
        ], 201);
    }

    public function show($medicalRecordNumber)
{
    $patient = Patient::where(
        'medical_record_number',
        $medicalRecordNumber
    )->first();

    if (!$patient) {
        return response()->json([
            'message' => 'Patient not found'
        ], 404);
    }

    return response()->json([
        'medical_record_number' => $patient->medical_record_number,
        'nik' => Crypt::decryptString($patient->nik),
        'name' => $patient->name,
        'email' => Crypt::decryptString($patient->email),
        'address' => $patient->address,
        'birth_date' => $patient->birth_date,
        'total_visits' => $patient->visits()->count(),
    ]);
}
}
