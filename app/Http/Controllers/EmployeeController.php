<?php 
namespace App\Http\Controllers;

use Illuminate\Http\{Request, JsonResponse};
use App\Employee;

class EmployeeController extends Controller
{
    protected $employee;
    public function __construct(Employee $employee)
    {
        $this->employee = $employee;
    }

    public function store(Request $request): JsonResponse
    {
        //validate incoming request
        $data = $this->validate($request, [
            'pegawai_nama' => 'required|max:255',
            'pegawai_jabatan' => 'required|max:30',
            'pegawai_umur' => 'required|integer',
            'pegawai_alamat' => 'required'
        ]);

        try {
            $employee = $this->employee->create($data);

            //return successful response
            return response()->json([
                'status' => true,
                'message' => 'Data berhasil dibuat.',
                'data' => $employee
            ], 201);
        } catch (\Exception $e) {
            //return error message
            return response()->json([
                'status' => false,
                'message' => 'Create data gagal'
            ], 409);
        }

    }

    public function index(): JsonResponse
    {
        $employee = $this->employee->all();
        return response()->json([
            'data' => $employee
        ], 200);
    }

    public function show(int $id): JsonResponse
    {
        $employee = $this->employee->findOrFail($id);
        return response()->json([
            'data' => $employee
        ], 200);
    }

    
}
