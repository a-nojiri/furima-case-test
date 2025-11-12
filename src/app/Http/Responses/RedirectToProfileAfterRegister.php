<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\RegisterResponse;

class RedirectToProfileAfterRegister implements RegisterResponse
{
    public function toResponse($request)
    {
        return redirect()->intended(route('mypage.profile.edit'));
    }
}