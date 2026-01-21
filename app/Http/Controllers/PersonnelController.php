<?php

namespace App\Http\Controllers;

use App\Models\Personnel;
use Illuminate\Http\Request;

class PersonnelController extends Controller
{
    /**
     * Display the personnel management system.
     */
    public function index()
    {
        $personnelData = Personnel::all();
        return view('personnel', ['personnel' => $personnelData]);
    }

    /**
     * Store a newly created personnel record in database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'fullName' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'contact' => 'required|string|max:20',
            'email' => 'required|email',
            'address' => 'required|string',
            'employeeId' => 'nullable|string',
        ]);

        try {
            Personnel::create([
                'full_name' => $validated['fullName'],
                'position' => $validated['position'],
                'department' => $validated['department'],
                'contact' => $validated['contact'],
                'email' => $validated['email'],
                'address' => $validated['address'],
                'employee_id' => $validated['employeeId'] ?? null,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Personnel record saved successfully'
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error saving personnel record: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display personnel statistics.
     */
    public function statistics()
    {
        $total = Personnel::count();
        $departments = Personnel::distinct('department')->count('department');
        $recent = Personnel::latest('date_added')->limit(5)->get();

        return response()->json([
            'total' => $total,
            'departments' => $departments,
            'recent' => $recent
        ]);
    }

    /**
     * Update personnel record.
     */
    public function update(Request $request, Personnel $personnel)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'contact' => 'required|string|max:20',
            'email' => 'required|email',
            'address' => 'required|string',
            'employee_id' => 'nullable|string',
        ]);

        try {
            $personnel->update($validated);
            return response()->json([
                'success' => true,
                'message' => 'Personnel record updated successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating personnel record: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Delete personnel record.
     */
    public function destroy(Personnel $personnel)
    {
        try {
            $personnel->delete();
            return response()->json([
                'success' => true,
                'message' => 'Personnel record deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting personnel record: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Search personnel records.
     */
    public function search(Request $request)
    {
        $query = $request->input('q', '');
        $results = Personnel::search($query)->get();

        return response()->json($results);
    }

    /**
     * Export personnel records to CSV.
     */
    public function export()
    {
        $personnelData = Personnel::all();
        
        $csv = "ID,Full Name,Position,Department,Contact,Email,Address,Employee ID,Date Added\n";
        
        foreach ($personnelData as $person) {
            $csv .= "{$person->id},\"{$person->full_name}\",\"{$person->position}\",\"{$person->department}\",{$person->contact},\"{$person->email}\",\"{$person->address}\",{$person->employee_id},{$person->date_added}\n";
        }

        return response($csv, 200)
            ->header('Content-Type', 'text/csv')
            ->header('Content-Disposition', 'attachment; filename="personnel_records.csv"');
    }
}
