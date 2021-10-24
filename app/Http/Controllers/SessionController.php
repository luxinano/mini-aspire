<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    public function store(Request $request)
    {
        $credentials = $request->only('name', 'password');
        if (Auth::attempt($credentials)) {
            return new UserResource(Auth::user());
        }
        return response()->json('Login failed: Invalid username or password.', 422);
    }

    public function destroy()
    {
        Auth::guard('web')->logout();
        return response('', 204);
    }
}
