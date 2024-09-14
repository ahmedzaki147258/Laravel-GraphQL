<?php

namespace App\Http\Controllers;

use App\Exports\StudentsExport;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Resources\StudentResource;
use App\Imports\StudentsImport;
use App\Models\Student;
use App\Services\StudentService;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

/**
 * @OA\Info(title="My API", version="1.0.0")
 */
class StudentController extends Controller
{
    use ApiResponseTrait;
    protected $studentService;
    public function __construct(StudentService $studentService)
    {
        $this->studentService = $studentService;
    }

    /**
     * @OA\Get(
     *     path="/api/students",
     *     summary="Get list of students",
     *     tags={"Students"},
     *     @OA\Parameter(
     *         name="userType",
     *         in="header",
     *         description="Type of the user making the request (user, admin, manager)",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *             enum={"user", "admin", "manager"}
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="A list of students",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Student"))
     *     )
     * )
     */
    public function index(){
        return StudentResource::collection(Student::all());
    }

    public function show(int $id){
        try{
            return new StudentResource(Student::findOrFail($id));
        }catch(\Exception $e){
            return $this->apiResponse((object)[], 'Student not found', 404);
        }
    }

    /**
     * @OA\Post(
     *     path="/api/student",
     *     summary="Create a new student",
     *     tags={"Students"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Student")
     *     ),
     *     @OA\Parameter(
     *         name="userType",
     *         in="header",
     *         description="Type of the user making the request (user, admin, manager)",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *             enum={"user", "admin", "manager"}
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Student created",
     *         @OA\JsonContent(ref="#/components/schemas/Student")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid input"
     *     )
     * )
     */
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'age' => 'required|integer',
            'country' => 'required|string|max:255',
            'departmentId' => 'required|exists:departments,id'
        ]);
        if($validator->fails()){
            return $this->apiResponse((object)[], $validator->errors(), 404);
        }

        $student = $this->studentService->createStudent($request);
        return new StudentResource($student);
    }

    public function export(){
        return Excel::download(new StudentsExport, 'students.xlsx');
    }

    public function import(Request $request){
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:xlsx,csv'
        ]);
        if($validator->fails()){
            return $this->apiResponse((object)[], $validator->errors(), 404);
        }

        $data = Excel::toCollection(new StudentsImport, $request->file('file'));
        return $this->apiResponse($data, 'Imported successfully', 200);
    }
}
