<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Models\Position;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePositionRequest;
use App\Http\Requests\UpdatePositionRequest;

class PositionController extends Controller
{
    public function fetch(Request $request)
    {
        $id = $request->input('id');
        $name = $request->input('name');
        $limit = $request->input('limit', 10);

        //siak.com/api/position?id=1
        $positionQuery = Position::query();

        // Get single data
        if ($id) {
            $position = $positionQuery->find($id);

            if ($position) {
                return ResponseFormatter::success($position, 'Position found');
            }

            return ResponseFormatter::error('Position not found', 404);
        }


        //siak.com/api/position
        // Get multiple data
        $positions = $positionQuery->where('employee_id', $request->employee_id);

        if ($name) {
            $positions->where('name', 'like', '%' . $name . '%');
        }

        return ResponseFormatter::success(
            $positions->paginate($limit),
            'Positions Success'
        );
    }

    public function create(CreatePositionRequest $request)
    {

        try {
            // Upload icon
            if ($request->hasFile('icon')) {
                $path = $request->file('icon')->store('public/icons');
            }

            // Create Position
            $position = Position::create([
                'name' => $request->name,
                'icon' => $path,
                'employee_id' => $request->employee_id,
            ]);

            if (!$position) {
                throw new Exception('Position not created');
            }

            return ResponseFormatter::success($position, 'Position created');
        } catch (Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 500);
        }
    }

    public function update(UpdatePositionRequest $request, $id)
    {
        try {
            // Get Position
            $position = Position::find($id);

            // Check if position exits
            if (!$position) {
                throw new Exception('position not found');
            }

            // Upload icon
            if ($request->hasFile('icon')) {
                $path = $request->file('icon')->store('public/icons');
            }

            // Update Position
            $position->update([
                'name' => $request->name,
                'icon' => isset($path) ? $path : $position->icon,
                'position_id' => $request->position_id,
            ]);

            return ResponseFormatter::success($position, 'Position updated');
        } catch (Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 500);
        }
    }

    public function destroy($id)
    {
        try {
            // get Position
            $position = Position::find($id);

            // TODO: Check if position is owned by user

            // Check if position exits
            if (!$position) {
                throw new Exception('Position not found');
            }

            // Delete Position
            $position->delete();

            return ResponseFormatter::success('Position deleted');
        } catch (Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 500);
        }
    }
}
