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
            'medical_record_number' => 'required'
        ]);

        $patient = Patient::where(
            'medical_record_number',
            $request->medical_record_number
        )->first();

        if (!$patient) {
            return response()->json([
                'message' => 'Patient not found'
            ], 404);
        }

        Visit::create([
            'patient_id' => $patient->id,
            'visit_date' => now(),
        ]);

        $totalVisits = $patient->visits()->count();

        return response()->json([
            'message' => 'Visit created successfully',
            'patient' => [
                'name' => $patient->name,
                'medical_record_number' => $patient->medical_record_number,
            ],
            'total_visits' => $totalVisits,
        ]);
    }
}