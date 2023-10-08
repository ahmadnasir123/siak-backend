<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateRoleRequest;
use App\Http\Requests\UpdateRoleRequest;

class RoleController extends Controller
{
    public function fetch(Request $request)
    {
        $id = $request->input('id');
        $name = $request->input('name');
        $limit = $request->input('limit', 10);
        $with_responsibilities = $request->input('with_responsibilities', 0);

        //powerhuman.com/api/role?id=1
        $roleQuery = Role::query();

        // Get single data
        if ($id) {
            $role = $roleQuery->with('responsibilities')->find($id);

            if ($role) {
                return ResponseFormatter::success($role, 'Role found');
            }

            return ResponseFormatter::error('Role not found', 404);
        }


        //powerhuman.com/api/role
        // Get multiple data
        $roles = $roleQuery->where('user_id', $request->user_id);

        if ($name) {
            $roles->where('name', 'like', '%' . $name . '%');
        }
        if ($with_responsibilities) {
            $roles->with('responsibilities');
        }

        return ResponseFormatter::success(
            $roles->paginate($limit),
            'Roles Success'
        );
    }

    public function create(CreateRoleRequest $request)
    {

        try {

            // Create Role
            $role = Role::create([
                'name' => $request->name,
                'user_id' => $request->user_id,
            ]);

            if (!$role) {
                throw new Exception('Role not created');
            }

            return ResponseFormatter::success($role, 'Role created');
        } catch (Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 500);
        }
    }

    public function update(UpdateRoleRequest $request, $id)
    {
        try {
            // Get Role
            $role = Role::find($id);

            // Check if role exits
            if (!$role) {
                throw new Exception('role not found');
            }

            // Update Role
            $role->update([
                'name' => $request->name,
                'user_id' => $request->user_id,
            ]);

            return ResponseFormatter::success($role, 'Role updated');
        } catch (Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 500);
        }
    }

    public function destroy($id)
    {
        try {
            // get Role
            $role = Role::find($id);

            // TODO: Check if role is owned by user

            // Check if role exits
            if (!$role) {
                throw new Exception('Role not found');
            }

            // Delete Role
            $role->delete();

            return ResponseFormatter::success('Role deleted');
        } catch (Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 500);
        }
    }
}
