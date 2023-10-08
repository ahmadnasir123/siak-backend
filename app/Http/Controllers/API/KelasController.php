<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Models\Kelas;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateKelasRequest;
use App\Http\Requests\UpdateKelasRequest;

class KelasController extends Controller
{
    public function fetch(Request $request)
    {
        $id = $request->input('id');
        $name = $request->input('name');
        $course_id = $request->input('course_id');
        $employee_id = $request->input('employee_id');
        $student_id = $request->input('student_id');
        $limit = $request->input('limit', 10);

        //siak.com/api/kelas?id=1
        $kelasQuery = Kelas::query();

        // Get single data
        if ($id) {
            $kelas = $kelasQuery->find($id);

            if ($kelas) {
                return ResponseFormatter::success($kelas, 'Kelas found');
            }

            return ResponseFormatter::error('Kelas not found', 404);
        }


        //siak.com/api/kelas
        // Get multiple data
        // $kelass = $kelasQuery->where('employee_id', $request->employee_id);
        $kelass = $kelasQuery;

        if ($name) {
            $kelass->where('name', 'like', '%' . $name . '%');
        }
        if ($course_id) {
            $kelass->where('course_id', $course_id);
        }
        if ($employee_id) {
            $kelass->where('employee_id', $employee_id);
        }
        if ($student_id) {
            $kelass->where('student_id', $student_id);
        }

        return ResponseFormatter::success(
            $kelass->paginate($limit),
            'Kelass Success'
        );
    }

    public function create(CreateKelasRequest $request)
    {

        try {
           
            // Create Kelas
            $kelas = Kelas::create([
                'name' => $request->name,
                'course_id' => $request->course_id,
                'employee_id' => $request->employee_id,
                'student_id' => $request->student_id,

            ]);

            if (!$kelas) {
                throw new Exception('Kelas not created');
            }

            return ResponseFormatter::success($kelas, 'Kelas created');
        } catch (Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 500);
        }
    }

    public function update(UpdateKelasRequest $request, $id)
    {
        try {
            // Get Kelas
            $kelas = Kelas::find($id);

            // Check if kelas exits
            if (!$kelas) {
                throw new Exception('kelas not found');
            }

            // // Upload icon
            // if ($request->hasFile('icon')) {
            //     $path = $request->file('icon')->store('public/icons');
            // }

            // Update Kelas
            $kelas->update([
                'name' => $request->name,
                'course_id' => $request->course_id,
                'employee_id' => $request->employee_id,
                'student_id' => $request->student_id,
            ]);

            return ResponseFormatter::success($kelas, 'Kelas updated');
        } catch (Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 500);
        }
    }

    public function destroy($id)
    {
        try {
            // get Kelas
            $kelas = Kelas::find($id);

            // TODO: Check if kelas is owned by user

            // Check if kelas exits
            if (!$kelas) {
                throw new Exception('Kelas not found');
            }

            // Delete Kelas
            $kelas->delete();

            return ResponseFormatter::success('Kelas deleted');
        } catch (Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 500);
        }
    }
}
