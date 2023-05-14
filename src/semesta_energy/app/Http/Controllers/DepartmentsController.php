<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepartmentRequest;
use App\Http\Resources\ResponseCollection;
use App\Http\Resources\ResponseListCollection;
use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;

class DepartmentsController extends Controller
{
    public function index(Request $request)
    {
        $limit = $request->limit ?? 10;
        return new ResponseListCollection(searchMethod($request, 'App\Models\Department', 'department_name')->paginate($limit));
    }

    public function show($id)
    {
        $department = Department::find($id);

        if (!$department) {
            return notFoundResponse('Department not found');
        }

        return new ResponseCollection($department);


    }

    public function create(DepartmentRequest $request)
    {
        $department = new Department();
        $department->department_name = $request->department_name;
        $department->description = $request->description;
        $department->head_of_department_id = User::first()->id;
        $department->save();

        return new ResponseCollection($department);
    }

    public function editDepartment(DepartmentRequest $request, $id)
    {
        $department = Department::find($id);

        if (!$department) {
            return notFoundResponse('Department not found');
        }

        $department->department_name = $request->department_name;
        $department->description = $request->description;
        $department->save();

        return new ResponseCollection($department);
    }

    public function deleteDepartment($id)
    {
        $department = Department::find($id);

        if (!$department) {
            return notFoundResponse('Department not found');
        }

        $department->delete();

        return emptyResponse('Success delete Department');
    }
}
