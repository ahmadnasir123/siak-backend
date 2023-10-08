<?php

namespace App\Http\Controllers\API;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;

class EmployeeController extends Controller
{
    public function fetch(Request $request)
    {
        $id = $request->input('id');
        $nip = $request->input('nip');
        $name = $request->input('name');
        $email = $request->input('email');
        $gender = $request->input('gender');
        $age = $request->input('age');
        $phone = $request->input('phone');
        $user_id = $request->input('user_id');
        $position_id = $request->input('position_id');
        $course_id = $request->input('course_id');
        $kelas_id = $request->input('kelas_id');
        $limit = $request->input('limit', 10);

        //siak.com/api/employee?id=1
        $employeeQuery = Employee::query();

        // Get single data
        if ($id) {
            $employee = $employeeQuery->with(['user', 'position', 'course', 'kelas'])->find($id);

            if ($employee) {
                return ResponseFormatter::success($employee, 'Employee found');
            }

            return ResponseFormatter::error('Employee not found', 404);
        }


        //siak.com/api/employee
        // Get multiple data
        $employees = $employeeQuery;

        if ($name) {
            $employees->where('name', 'like', '%' . $name . '%');
        }
        if ($email) {
            $employees->where('email', $email);
        }
        if ($gender) {
            $employees->where('gender', $gender);
        }
        if ($age) {
            $employees->where('age', $age);
        }
        if ($phone) {
            $employees->where('phone', 'like', '%' . $phone . '%');
        }
        if ($user_id) {
            $employees->where('user_id', $user_id);
        }
        if ($position_id) {
            $employees->where('position_id', $position_id);
        }
        if ($course_id) {
            $employees->where('course_id', $course_id);
        }
        if ($kelas_id) {
            $employees->where('kelas_id', $kelas_id);
        }

        return ResponseFormatter::success(
            $employees->paginate($limit),
            'Employees Success'
        );
    }
}
