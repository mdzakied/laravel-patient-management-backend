<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PatientController extends Controller
{
    // Add Patient
    public function create(Request $request)
    {
        // Validation
        $request->validate([
            'name' => 'required|string|max:255|unique:patients,name',
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:male,female,other',
            'phone_number' => 'nullable|string|max:20|unique:patients,phone_number',
            'email' => 'nullable|email|max:255|unique:patients,email',
            'address' => 'nullable|string',
            'emergency_contact_name' => 'nullable|string|max:255',
            'emergency_contact_phone' => 'nullable|string|max:20',
        ]);

        // Add request data
        $data = $request->all();

        // Assign the logged-in user's ID
        $data['user_id'] = Auth::id();

        // Create the patient with the user_id
        $patient = Patient::create($data);

        // Load user
        $patient->load('user');

        // Return response
        return response()->json([
            'message' => 'Patient added successfully',
            'data' => $patient
        ], 201);
    }

    // Show All Patients with Filter and Pagination
    public function showAll(Request $request)
    {
        // Get page and size parameters from the request, with defaults
        $page = $request->input('page', 1); // Default to page 1 if not provided
        $size = $request->input('size', 10); // Default to 10 items per page if not provided

        // Initialize query
        $query = Patient::query();

        // Filter by name if provided
        if ($request->has('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        // Filter by is_active if provided
        if ($request->has('is_active')) {
            $query->where('is_active', $request->is_active);
        }

        // Sorting logic: Get the sort and direction parameters
        $sort = $request->input('sort', 'name'); // Default to 'name' if no sort parameter is provided
        $direction = $request->input('direction', 'asc'); // Default to 'asc' if no direction is provided

        // validate sort to be either 'name', 'date_of_birth', 'created_at', 'updated_at'
        if (!in_array($sort, ['name', 'date_of_birth', 'created_at', 'updated_at'])) {
            $sort = 'name'; // Set default sort to 'name' if the value is invalid
        }

        // Validate direction to be either 'asc' or 'desc'
        if (!in_array(strtolower($direction), ['asc', 'desc'])) {
            $direction = 'asc'; // Set default direction to 'asc' if the value is invalid
        }

        // Apply sorting to the query
        $query->orderBy($sort, $direction);

        // Paginate the results with dynamic page and size
        $patients = $query->with('user')->paginate($size, ['*'], 'page', $page);

        // Return response
        return response()->json([
            'message' => 'Patients data retrieved successfully',
            'data' => $patients
        ], 200);
    }

    // Show Patient
    public function show($id)
    {
        // Find patient
        $patient = Patient::with('user')->find($id);

        // Load user
        $patient->load('user');

        // Return response or error
        if (!$patient) {
            return response()->json([
                'message' => 'Patient not found'
            ], 404);
        }

        // Return response
        return response()->json([
            'message' => 'Patient data retrieved successfully',
            'data' => $patient
        ], 200);
    }

    // Update Patient
    public function update(Request $request, $id)
    {

        // Find patient
        $patient = Patient::find($id);

        // Return response or error
        if (!$patient) {
            return response()->json([
                'message' => 'Patient not found'
            ], 404);
        }

        // Validation
        $request->validate([
            'name' => 'nullable|string|max:255|unique:patients,name,' . $patient->id,
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|in:male,female,other',
            'phone_number' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255|unique:patients,email,' . $patient->id,
            'address' => 'nullable|string',
            'emergency_contact_name' => 'nullable|string|max:255',
            'emergency_contact_phone' => 'nullable|string|max:20',
        ]);

        // Add request data
        $data = $request->all();

        // Get the currently authenticated user
        $user = Auth::user();

        // Update patient data
        $patient->fill($data);

        // update user
        $patient->user_id = $user->id;

        // Save updated data
        $patient->save();

        // Load user
        $patient->load('user');

        // Return response
        return response()->json([
            'message' => 'Patient updated successfully',
            'data' => $patient
        ], 200);
    }

    // Delete Patient
    public function delete($id)
    {

        // Get the currently authenticated user
        $user = Auth::user();

        // Find patient
        $patient = Patient::find($id);

        // Return response or error
        if (!$patient) {
            return response()->json([
                'message' => 'Patient not found'
            ], 404);
        }

        // Return response has been deleted
        if ($patient->is_active == false) {
            return response()->json([
                'message' => 'Patient already deleted'
            ], 400);
        }

        // Soft delete patient
        $patient->is_active = false;

        // update user
        $patient->user_id = $user->id;

        // Save
        $patient->save();

        // Return response
        return response()->json([
            'message' => 'Patient deleted successfully'
        ], 200);
    }
}
