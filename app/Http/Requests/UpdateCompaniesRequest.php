<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class UpdateCompaniesRequest extends FormRequest
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
    // dd($id);
    return [
      'name' => 'required|min:3',
      'email' => ['required', "email", Rule::unique('companies', 'email')->ignore($id, 'id')],
      'logo' => 'image|mimes:png|max:2048|dimensions:min_width=100,min_height=100',
      'website' => ['required','regex:/^((?:https?\:\/\/|www\.)(?:[-a-z0-9]+\.)*[-a-z0-9]+.*)$/']
    ];
  }
}
