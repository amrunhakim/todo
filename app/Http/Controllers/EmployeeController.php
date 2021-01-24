<?php 
namespace App\Http\Controllers;

use Illuminate\Http\{Request, JsonResponse};
use App\Models\Employee;
use DB;

class EmployeeController extends Controller
{
    protected $employee;
    public function __construct(Employee $employee)
    {
        $this->employee = $employee;
    }

    public function store(Request $request)
    {
        $data = new Employee();
        $data->pegawai_nama = $request->input('pegawai_nama');
        $data->pegawai_jabatan = $request->input('pegawai_jabatan');
        $data->pegawai_umur = $request->input('pegawai_umur');
        $data->pegawai_alamat = $request->input('pegawai_alamat');
        $data->save();

        //return successful response
        return response()->json([
            'status' => true,
            'message' => 'Data berhasil dibuat.',
            'data' => $data
        ], 201);
    

    }

    public function index()
    {
        //$employee = $this->employee->paginate(10);
        $employee = Employee::paginate(5);
        return response()->json([
            'data' => $employee
        ], 200);
    }

    public function show(int $id)
    {        
        //$employee = $this->employee->findOrFail($id);
        $employee = DB::select("SELECT * FROM employee WHERE pegawai_id = $id");
        return response()->json([
            'data' => $employee
        ], 200);
    }

    public function update(Request $request, int $id)
    {
        try {    
            $pegawai_nama = $request->input('pegawai_nama');
            $pegawai_jabatan = $request->input('pegawai_jabatan');
            $pegawai_umur = $request->input('pegawai_umur');
            $pegawai_alamat = $request->input('pegawai_alamat');
            
            $data = DB::select("UPDATE employee SET pegawai_nama = '$pegawai_nama', pegawai_jabatan = '$pegawai_jabatan', pegawai_umur = '$pegawai_umur', pegawai_alamat = '$pegawai_alamat', updated_at = now() WHERE pegawai_id = $id");
            
            $newdata = DB::select("SELECT * FROM employee WHERE pegawai_id = $id");
            
            //return successful response
            return response()->json([
                'status' => true,
                'message' => 'Data berhasil diupdate.',
                'data' => $newdata
            ], 201);
        } catch (\Exception $e) {
            //return error message
            return response()->json([
                'status' => false,
                'message' => 'Update data gagal.'
            ], 409);
        }
    }
    
    public function destroy(int $id): JsonResponse
    {        
        try {
            $employee = DB::select("DELETE FROM employee WHERE pegawai_id = $id");
            
            //return successful response
            return response()->json([
                'status' => true,
                'message' => 'Data berhasil dihapus.'
            ], 201);
        } catch (\Exception $e) {
            //return error message
            return response()->json([
                'status' => false,
                'message' => 'Hapus data gagal.'
            ], 409);
        }
    }

    
}
