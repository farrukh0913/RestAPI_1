<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
class StudentController extends Controller
{
    /**
        * @OA\Post(
        *     path="/createStudent",
        *     summary="Create a new student",
        *     @OA\RequestBody(
        *         required=true,
        *         @OA\MediaType(
        *             mediaType="application/json",
        *             @OA\Schema(
        *                 @OA\Property(property="first_name", type="string", example="John Doe", description="Student's name"),
        *                 @OA\Property(property="last_name", type="string", example="John Doe", description="Student's name"),
        *                 @OA\Property(property="email", type="string", example="A", description="Student's grade"),
        *                 @OA\Property(property="birthdate", type="string", example="123 Main St", description="Student's address"),
        *             )
        *         )
        *     ),
        *     @OA\Response(response="200", description="Successful operation"),
        * )
        */
    public function create(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email|unique:students,email',
            'birthdate' => 'required|string',
            // Add other validation rules as needed
        ]);

        // Create a new student record
        $student = Student::create([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'birthdate' => $request->input('birthdate'),
            // Add other fields as needed
        ]);

        // Return a JSON response indicating success
        return response()->json(['message' => 'Student created successfully', 'student' => $student]);
    }

        /**
     * @OA\Get(
     *     path="/getAllStudents",
     *     summary="Get example data",
     *     @OA\Response(response="200", description="Successful operation"),
     * )
     */
    public function getAllStudents()
    {
        // Retrieve all students from the database
        $students = Student::all();

        // Return a JSON response with the list of students
        return response()->json(['message' => 'All students retrieved successfully', 'students' => $students]);
    }
    public function updateStudent(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email|unique:students,email,' . $id,
            'birthdate' => 'required|string',
            // Add other validation rules as needed
        ]);

        // Find the student by ID
        $student = Student::find($id);

        // Check if the student exists
        if (!$student) {
            return response()->json(['error' => 'Student not found'], 404);
        }

        // Update the student record
        $student->update([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'birthdate' => $request->input('birthdate'),
            // Add other fields as needed
        ]);

        // Return a JSON response indicating success
        return response()->json(['message' => 'Student updated successfully', 'student' => $student]);
    }

    /**
 * @OA\Delete(
 *     path="/deleteStudent/{id}",
 *     summary="Delete a student by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID of the student to be deleted",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(response="200", description="Successful operation"),
 *     @OA\Response(response="404", description="Student not found"),
 * )
 */
    public function deleteStudent($id)
    {
        // Find the student by ID
        $student = Student::find($id);

        // Check if the student exists
        if (!$student) {
            return response()->json(['error' => 'Student not found'], 404);
        }

        // Delete the student record
        $student->delete();

        // Return a JSON response indicating success
        return response()->json(['message' => 'Student deleted successfully']);
    }
}
