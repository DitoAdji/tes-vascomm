<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEmployeesRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use DB;
use App\Models\Companies;
use App\Models\Employee;
use Faker\Provider\ar_JO\Company;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $data = DB::table('companies')
      ->join('employees', 'companies.id', 'employees.company_id')
      ->select('*', 'companies.name as company')
      ->orderBy('employees.created_at', 'desc')
      ->paginate(5);
    return view('employee.index', compact('data'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $data = Companies::select('id', 'name')->get();
    return view('employee.create', compact('data'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(CreateEmployeesRequest $request)
  {
    $validator = $request->validated();

    $input = $request->all();
    Employee::create($input);
    return redirect()->route('employee.index')->withStatus(__('Employee created.'));
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Employee  $employee
   * @return \Illuminate\Http\Response
   */
  public function show(Employee $employee)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Employee  $employee
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $dataEmp = Employee::find($id);
    $dataComp = Companies::get();
    return view('employee.edit', compact('dataEmp', 'dataComp'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Employee  $employee
   * @return \Illuminate\Http\Response
   */
  public function update(UpdateEmployeeRequest $request, $id)
  {
    $data = Employee::find($id);
    $validator = $request->validated();

    $input = $request->all();
    $data->update($input);
    return redirect()->route('employee.index')->withStatus(__('Employee updated.'));
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Employee  $employee
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $data = Employee::find($id);
    $data->delete();
    return back()->withStatus(__('Employee deleted.'));
  }
}
