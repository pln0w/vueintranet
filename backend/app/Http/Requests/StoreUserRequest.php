<?php namespace App\Http\Requests;

class StoreUserRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'email'         => 'required|email',
            'first_name'    => 'required',
            'last_name'     => 'required',
            'password'      => 'required',
        ];
    }

    /**
     * @return array
     */
    public function messages() {
        return [
            'email.required' => 'Email field is required',
            'first_name.required' => 'First name field is required',
            'last_name.required' => 'Last name field is required',
            'password.required' => 'Password field is required'
        ];
    }

}