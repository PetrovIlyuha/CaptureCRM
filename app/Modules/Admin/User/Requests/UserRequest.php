<?php

namespace App\Modules\Admin\User\Requests;

use App\Services\Requests\ApiRequest;
use Illuminate\Support\Facades\Auth;

class UserRequest extends ApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
       return Auth::user()->canDo(['SUPER_ADMINISTRATOR', 'USER_ACCESS']);
    }

    protected function getValidatorInstance()
    {
        $validator =  parent::getValidatorInstance();
        $validator->sometimes('password',['required', 'confirmed'],function ($input) {
            if (!empty($input->password)
                ||
                (empty($input->password) && ($this->route()->getName() != 'api.users.update'))) {
                return true;
            } else {
                return false;
            }

        });
        return $validator;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'role_id' => 'required'
        ];
    }
}
