<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ImpersonateController extends Controller
{
    public function impersonate(User $user)
    {
        session()->put('original_user_id', auth()->id());

        auth()->login($user);

        return redirect('/');
    }

    public function stopImpersonating()
    {
        if (session()->has('original_user_id')) {
            $originalUserId = session()->get('original_user_id');

            auth()->logout();

            $user = User::find($originalUserId); // Get the original user instance

            auth()->login($user); // Log in as the original user

            session()->forget('original_user_id');
        }

        return redirect()->route('pengguna');
    }
}
