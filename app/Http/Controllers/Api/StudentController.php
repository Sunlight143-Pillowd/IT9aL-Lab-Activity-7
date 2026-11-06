<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response() ->json(Student::all(),200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
        'student_number' => 'required|string|max:50|unique:student,student_number',
        'name' => 'required|string|max:255',
        'course' => 'required|string|max:255',
        'age' => 'required|integer|min:1',
        'email' => 'required|email|unique:student,email',
        ]);

        $student = Student::create($validated);

        return response()->json([
            'message' => 'Student created successfully.',
            'data' => $student
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $student = Student::find($id);

        if(!$student){
            return response()-> json([
                'message' => 'Student not found.'
            ], 404);
        }

        return response()-> json([
            $student, 200
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $student = Student::find($id);

        if(!$student){
            return response()-> json([
                'message' => 'Student not found.'
            ], 404);
        }

        $validated = $request->validate([
        'student_number' => 'required|string|max:50|unique:student,student_number,'. $id,
        'name' => 'required|string|max:255',
        'course' => 'required|string|max:255',
        'age' => 'required|integer|min:1',
        'email' => 'required|email|unique:student,email,'. $id,
        ]);

        $student->update($validated);

        return response()->json([
            'message' => 'Student updated successfully.',
            'data' => $student
        ], 201);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $student = Student::find($id);
        
        if(!$student){
            return response()-> json([
                'message' => 'Student not found.'
                ], 404);
        }
                
        $student->delete();
        
        return response()->json([
            'message' => 'Student deleted successfully.',
            'data' => $student
        ], 201);
    }
}
