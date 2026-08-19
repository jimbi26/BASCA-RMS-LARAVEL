<?php

namespace App\Http\Controllers;

use App\Models\SeniorCitizen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SeniorController
{
    // DASHBOARD
    // Fetch statistics and display 5 most recent seniors
    public function index()
    {
        // Get total count
        $totalSeniors = SeniorCitizen::count();

        // Get Male and Female counts in ONE query
        $genderCounts = SeniorCitizen::select(
            'sex',
            DB::raw('COUNT(*) as total')
        )
            ->whereIn('sex', ['Male', 'Female'])
            ->groupBy('sex')
            ->pluck('total', 'sex');

        $maleCount = $genderCounts['Male'] ?? 0;
        $femaleCount = $genderCounts['Female'] ?? 0;

        // Get 5 newest records
        $seniors = SeniorCitizen::latest('created_at')
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'seniors',
            'totalSeniors',
            'maleCount',
            'femaleCount'
        ));
    }

    // DISPLAY ALL SENIOR CITIZENS
    public function seniors()
    {
        $seniors = collect();

        return view('senior-records', compact('seniors'));
    }
    // SHOW ADD SENIOR PAGE
    public function create()
    {
        return view('add-senior-modal');
    }

    // STORE NEW SENIOR CITIZEN
    public function store(Request $request)
    {
        SeniorCitizen::create(
            $request->only([
                'senior_id',
                'rrn',
                'first_name',
                'middle_name',
                'last_name',
                'birth_date',
                'sex',
                'barangay',
                'contact_number',
                'photo',
                'psa',
                'ncsc_form',
                'senior_id_image',
                'purok',
                'age',
                'pension',
                'philhealth_number',
                'dependency',
                'housing',
                'health_problems',
                'disability',
                'medicines',
            ])
        );

        return redirect()->route('seniors.senior-records');
    }

    // SHOW SENIOR CITIZEN
    public function show($senior_id)
    {
        $senior = SeniorCitizen::where('senior_id', $senior_id)->firstOrFail();
        return view('components.view-senior', compact('senior'));
    }

    // SHOW EDIT SENIOR PAGE
    public function edit($senior_id)
    {
        $senior = SeniorCitizen::where('senior_id', $senior_id)->firstOrFail();
        return view('components.edit-senior', compact('senior'));
    }

    // UPDATE SENIOR CITIZEN
    public function update(Request $request, $senior_id)
    {
        $senior = SeniorCitizen::where('senior_id', $senior_id)->firstOrFail();

        $data = $request->only([
            'rrn',
            'first_name',
            'middle_name',
            'last_name',
            'birth_date',
            'sex',
            'barangay',
            'contact_number',
            'purok',
            'age',
            'pension',
            'philhealth_number',
            'dependency',
            'housing',
            'health_problems',
            'disability',
            'medicines',
        ]);

        // Handle file uploads — only replace when a new file is provided
        foreach (['photo', 'senior_id_image', 'psa', 'ncsc_form'] as $field) {
            if ($request->hasFile($field) && $request->file($field)->isValid()) {
                $file = $request->file($field);
                $filename = time() . '_' . $senior_id . '_' . $field . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('storage'), $filename);
                $data[$field] = $filename;
            }
        }

        $senior->update($data);

        return redirect()->route('seniors.show', $senior->senior_id);
    }


    // DELETE SENIOR CITIZEN
    public function destroy($senior_id)
    {
        $senior = SeniorCitizen::where('senior_id', $senior_id)->firstOrFail();

        $senior->delete();

        return redirect()
            ->route('seniors.senior-records')
            ->with('success', 'Senior citizen deleted successfully.');
    }
}