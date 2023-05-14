<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeEditRequest;
use App\Http\Requests\EmployeeRequest;
use App\Http\Resources\ResponseCollection;
use App\Http\Resources\ResponseListCollection;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeesController extends Controller
{
    public function index(Request $request)
    {
        $limit = $request->limit ?? 10;
        return new ResponseListCollection(searchMethod($request, 'App\Models\Employee', 'name')->paginate($limit));
    }

    public function show($id)
    {
        $employee = Employee::find($id);

        if (!$employee) {
            return notFoundResponse('Employee not found');
        }
        return new ResponseCollection($employee);

    }

    public function create(EmployeeRequest $request)
    {
        $employee = new Employee();
        $this->payload($employee, $request);
        $employee->save();

        return new ResponseCollection($employee);
    }

    private function payload($employee, $request)
    {
        $employee->name = $request->name;
        $employee->id_card = $request->id_card;
        $employee->gender = $request->gender;
        $employee->religion = $request->religion;
        $employee->photo = $request->photo;
        $employee->address = $request->address;
        $employee->handphone = $request->handphone;
        $employee->job_position_id = $request->job_position_id;
    }

    public function editEmployee(EmployeeEditRequest $request, $id)
    {

        if (!$request->user()->can('edit employee')) {
            return warningResponse('Only role user can do this action', 403);
        }

        $employee = Employee::find($id);

        if (!$employee) {
            return notFoundResponse('Employee not found');
        }

        $this->payload($employee, $request);

        $employee->save();

        return new ResponseCollection($employee);
    }

    public function deleteEmployee($id)
    {
        $employee = Employee::find($id);

        if (!$employee) {
            return notFoundResponse('Employee not found');
        }

        $employee->delete();

        return emptyResponse('Success delete Employee');
    }
}
