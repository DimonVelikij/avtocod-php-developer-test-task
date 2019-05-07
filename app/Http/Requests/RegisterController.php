<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterController extends FormRequest
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
        return [
            'name'                  =>  'required|string|min:8|max:255|regex:/^[a-z0-9]+$/i',
            'email'                 =>  'required|string|email|max:255|unique:users',
            'password'              =>  'required|string|min:6|confirmed|regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$/',
            'password_confirmation' =>  'required|string|min:6|regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$/'
        ];
    }

    /**
     * Get error messages
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required'                     =>  'Поле обязательно для заполнения',
            'name.min'                          =>  'Поле должно содержать не менне 8 символов',
            'name.max'                          =>  'Поле должно содержать не более 255 символов',
            'name.regex'                        =>  'Поле может содержать альфа-симовлы и цифры',
            'email.required'                    =>  'Поле обязательно для заполнения',
            'email.email'                       =>  'Значение поля недопустимо',
            'email.unique'                      =>  'Данный E-mail уже используется',
            'email.max'                         =>  'Поле должно содержать не более 255 символов',
            'password.required'                 =>  'Поле обязательно для заполнения',
            'password.min'                      =>  'Поле должно содержать не менне 6 символов',
            'password.confirmed'                =>  'Пароли не совпадают',
            'password.regex'                    =>  'Поле должно содержать символы в верхнем и нижнем регистре + цифры',
            'password_confirmation.required'    =>  'Поле обязательно для заполнения',
            'password_confirmation.min'         =>  'Поле должно содержать не менне 6 символов',
            'password_confirmation.regex'       =>  'Поле должно содержать символы в верхнем и нижнем регистре + цифры',
        ];
    }
}
