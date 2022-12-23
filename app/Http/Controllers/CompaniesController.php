<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCompaniesRequest;
use App\Models\Companies;
use App\Http\Requests\UpdateCompaniesRequest;

class CompaniesController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $data = Companies::orderBy('created_at', 'desc')->paginate(5);
    return view('companies.index', compact('data'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('companies.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(CreateCompaniesRequest $request)
  {
    $validator = $request->validated();

    $input = $request->all();
    if ($image = $request->file('logo')) {
      $destinationPath = 'company/';
      $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
      $image->move($destinationPath, $profileImage);
      $input['logo'] = "$profileImage";
    }
    Companies::create($input);
    return redirect()->route('companies.index')->withStatus(__('Companies created.'));
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $data = Companies::find($id);
    return view('companies.edit', compact('data'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(UpdateCompaniesRequest $request, $id)
  {
    $data = Companies::find($id);
    $validator = $request->validated();

    $input = $request->all();
    if ($image = $request->file('logo')) {
      $destinationPath = 'company/';
      $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
      $image->move($destinationPath, $profileImage);
      $input['logo'] = "$profileImage";
    } else {
      unset($input['logo']);
    }
    $data->update($input);
    return redirect()->route('companies.index')->withStatus(__('Companies updated.'));
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $data = Companies::find($id);
    $data->delete();
    return back()->withStatus(__('Companies deleted.'));
  }
}
