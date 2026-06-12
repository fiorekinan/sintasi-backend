<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\Visit;
use Illuminate\Http\Request;

class VisitController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'medical_record_number' => 'required|string'
        ]);

        $patient = Patient::where(
            'medical_record_number',
            $request->medical_record_number
        )->first();

        if (!$patient) {
            return response()->json([
                'message' => 'Patient not found',
                'received' => $request->medical_record_number
            ], 404);
        }

        $visit = Visit::create([
            'patient_id' => $patient->id,
            'visit_date' => now(),
        ]);

        return response()->json([
            'message' => 'Visit created successfully',
            'visit' => $visit,
            'patient' => [
                'id' => $patient->id,
                'name' => $patient->name,
                'medical_record_number' => $patient->medical_record_number,
            ],
            'total_visits' => $patient->visits()->count(),
        ], 201);
    }
}