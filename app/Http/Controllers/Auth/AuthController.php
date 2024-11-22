<?php

namespace App\Http\Controllers\Auth;

use App\Domain\Users\Resources\ProfileResource;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if (Auth::attempt(['login' => $request->login, 'password' => $request->password])) {
            $user = User::where('login', $request->login)->first();

            $token = $user->createToken('token-name', [$user->login])->plainTextToken;
            return $this->successResponse([
                'token' => $token,
            ], new ProfileResource($user));
        }
        return $this->errorResponse('Login or password error', 404);
    }
}
