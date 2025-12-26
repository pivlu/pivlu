<?php

namespace Pivlu\Http\Auth;

use Laravel\Fortify\Contracts\RegisterResponse as RegisterResponseContract;

class RegisterResponse implements RegisterResponseContract
{

    public function toResponse($request)
    {

        return redirect(route('register'));        
    }
}
