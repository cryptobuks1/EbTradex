<?php

namespace App\Http\Requests\Core;

use App\Http\Requests\Request;

class LoginRequest extends Request
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
        $validation = [
            'username' => 'required|between:1,255',
            'password' => 'required|between:1,255',
            'remember_me' => 'nullable|in:1',
        ];

        if( env('APP_ENV') != 'local' && admin_settings('display_google_captcha') == ACTIVE_STATUS_ACTIVE )
        {
            $validation['g-recaptcha-response'] = 'required|captcha';
        }

        return $validation;
    }

    public function attributes()
    {
        return ['g-recaptcha-response' => 'google captcha'];
    }
}
