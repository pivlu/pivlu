<?php

namespace Pivlu\Cms\Http\Auth;

use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{

    public function toResponse($request)
    {

        $role_group = Auth::user()->role_group ?? null;

        if ($role_group == 'admin') {
            return redirect(route('admin'));
        } elseif ($role_group == 'internal') {
            return redirect(route('admin'));
        } elseif ($role_group == 'registered') {
            return redirect(route('user'));
        } else
            return redirect(route('home'));

        return $request->wantsJson()
            ? response()->json(['two_factor' => false])
            : redirect()->intended(config('fortify.home'));
    }
}
