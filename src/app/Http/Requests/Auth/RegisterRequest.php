<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; 
    }

     public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'email' => ['required', 'email'],
            'password' => ['required', 'string', 'min:8'],
            'password_confirmation' => ['required', 'string', 'min:8', 'same:password'],
        ];
    }
    
    public function messages(): array
    {
        return [

            // 未入力
            'name.required' => 'お名前を入力してください',
            'email.required' => 'メールアドレスを入力してください',
            'password.required' => 'パスワードを入力してください',
            'password_confirmation.required' => 'パスワードを入力してください',

            // 形式
            'email.email' => 'メールアドレスはメール形式で入力してください',

            // 規則違反
            'password.min' => 'パスワードは8文字以上で入力してください',
            'password_confirmation.min' => 'パスワードは8文字以上で入力してください',

            // 不一致
            'password_confirmation.same' => 'パスワードと一致しません',
        ];
    }
}
