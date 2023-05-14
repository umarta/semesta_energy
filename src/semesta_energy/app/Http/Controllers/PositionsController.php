<?php

namespace App\Http\Controllers;

use App\Http\Requests\AssignDepartmentToPositionRequest;
use App\Http\Requests\PositionRequest;
use App\Http\Resources\ResponseCollection;
use App\Http\Resources\ResponseListCollection;
use App\Models\Position;
use Illuminate\Http\Request;

class PositionsController extends Controller
{
    public function index(Request $request)
    {
        $limit = $request->limit ?? 10;
        return new ResponseListCollection(searchMethod($request, 'App\Models\Position', 'job_position_name')->paginate($limit));
    }

    public function show($id)
    {
        $position = Position::find($id);
        if (!$position) {
            return notFoundResponse('Position not found');
        }

        return new ResponseCollection($position);
    }

    public function create(PositionRequest $request)
    {
        $position = new Position();
        $position->job_position_name = $request->job_position_name;
        $position->description = $request->description;
        $position->save();

        return new ResponseCollection($position);
    }

    public function editPosition(PositionRequest $request, $id)
    {
        $position = Position::find($id);

        if (!$position) {
            return notFoundResponse('Position not found');
        }

        $position->job_position_name = $request->job_position_name;
        $position->description = $request->description;
        $position->save();

        return new ResponseCollection($position);
    }

    public function deletePosition($id)
    {
        $position = Position::find($id);

        if (!$position) {
            return notFoundResponse('Position not found');
        }

        $position->delete();

        return emptyResponse('Success delete position');
    }

    public function assignDepartment(AssignDepartmentToPositionRequest $request, $id)
    {
        $position = Position::find($id);
        if (!$position) {
            return notFoundResponse('Position not found');
        }

        $position->department_id = $request->department_id;
        $position->save();

        return new ResponseCollection($position);

    }
}
