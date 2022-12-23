<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class UpdateEmployeeRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    $id = Session::get('id');
    return [
      'name' => 'required|min:3',
      'company_id' => 'required',
      'email' => ['required', "email", Rule::unique('employees', 'email')->ignore($id, 'id')],
    ];
  }
}
