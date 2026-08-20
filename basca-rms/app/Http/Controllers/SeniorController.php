<?php

namespace App\Http\Controllers;

use App\Models\SeniorCitizen;
use App\Services\SupabaseStorageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SeniorController
{
    public function __construct(protected SupabaseStorageService $storage)
    {
    }
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
        $seniors = SeniorCitizen::latest('id')
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
        // Fetch all senior records ordered by newest first
        $seniors = SeniorCitizen::latest('id')->get();
        // In your Controller
        return view('senior-records', compact('seniors'));
    }

    // STORE NEW SENIOR CITIZEN
    public function store(Request $request)
    {
        $request->validate($this->validationRules());

        $data = $request->only([
            'senior_id',
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

        foreach (['photo', 'senior_id_image', 'psa', 'ncsc_form'] as $field) {
            if ($request->hasFile($field) && $request->file($field)->isValid()) {
                $file = $request->file($field);
                $filename = time() . '_' . $request->senior_id . '_' . $field . '.' . $file->getClientOriginalExtension();
                $uploaded = $this->storage->upload($filename, file_get_contents($file), $file->getMimeType());
                if (!$uploaded) {
                    return back()->with('error', 'Failed to upload ' . $field . '. Please try again.')->withInput();
                }
                $data[$field] = $filename;
            }
        }

        SeniorCitizen::create($data);

        return redirect()->route('seniors.senior-records')->with('success', 'Senior citizen added successfully.');
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

        $request->validate($this->validationRules($senior));

        $data = $request->only([
            'senior_id',
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

                if ($senior->$field) {
                    $this->storage->delete($senior->$field);
                }

                $uploaded = $this->storage->upload($filename, file_get_contents($file), $file->getMimeType());
                if (!$uploaded) {
                    return back()->with('error', 'Failed to upload ' . $field . '. Please try again.')->withInput();
                }
                $data[$field] = $filename;
            }
        }

        $senior->update($data);

        return redirect()->route('seniors.show', $senior->senior_id)->with('success', 'Record updated successfully.');
    }


    // DELETE SENIOR CITIZEN
    public function destroy($senior_id)
    {
        $senior = SeniorCitizen::where('senior_id', $senior_id)->firstOrFail();

        $senior->delete();

        // Check where the delete request came from
        if (url()->previous() === route('dashboard')) {
            return redirect()
                ->route('dashboard')
                ->with('success', 'Senior citizen deleted successfully.');
        }

        return redirect()
            ->route('seniors.senior-records')
            ->with('success', 'Senior citizen deleted successfully.');
    }
    public function printPhoto(Request $request)
    {
        $photoUrl = $request->query('url');

        return view('print.photo-a4', compact('photoUrl'));
    }

    public function destroyDocument(Request $request, $senior_id)
    {
        $field = $request->route('field');

        $allowedFields = ['photo', 'senior_id_image', 'psa', 'ncsc_form'];
        if (!in_array($field, $allowedFields)) {
            return back()->with('error', 'Invalid document type.');
        }

        $senior = SeniorCitizen::where('senior_id', $senior_id)->firstOrFail();

        $filename = $senior->$field;

        if ($filename) {
            $this->storage->delete($filename);
        }

        $senior->$field = null;
        $senior->save();

        return back()->with('success', ucfirst(str_replace('_', ' ', $field)) . ' deleted successfully.');
    }

    /**
     * Shared validation rules for storing and updating senior records.
     */
    protected function validationRules(?SeniorCitizen $senior = null): array
    {
        $uniqueSeniorId = 'unique:senior_citizens,senior_id';
        if ($senior) {
            $uniqueSeniorId .= ',' . $senior->senior_id . ',senior_id';
        }

        return [
            'senior_id' => ['required', 'string', 'max:50', $uniqueSeniorId],
            'rrn' => ['nullable', 'string', 'max:100'],
            'first_name' => ['required', 'string', 'max:100'],
            'middle_name' => ['nullable', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
            'birth_date' => ['nullable', 'date'],
            'sex' => ['required', 'in:Male,Female'],
            'barangay' => ['required', 'string', 'max:100'],
            'contact_number' => ['required', 'string', 'max:30'],
            'purok' => ['required', 'string', 'max:50'],
            'age' => ['nullable', 'integer', 'min:0', 'max:150'],
            'pension' => ['nullable', 'string', 'max:100'],
            'philhealth_number' => ['nullable', 'string', 'max:50'],
            'dependency' => ['nullable', 'string', 'max:100'],
            'housing' => ['nullable', 'string', 'max:100'],
            'health_problems' => ['nullable', 'string', 'max:255'],
            'disability' => ['nullable', 'string', 'max:255'],
            'medicines' => ['nullable', 'string', 'max:255'],
            'photo' => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:10240'],
            'senior_id_image' => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:10240'],
            'psa' => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:10240'],
            'ncsc_form' => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:10240'],
        ];
    }
}