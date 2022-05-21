<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Trait\RespondWithToken;

class LoginController extends Controller
{
    use RespondWithToken;

    /**
     * Authenticate the user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(LoginRequest $request)
    {
        if (!auth()->attempt($request->only('email', 'password'))) {
            return response()->json(['message' => 'The credentials does not match our records.'], Response::HTTP_UNAUTHORIZED);
        }

        $user = User::whereEmail($request->email)->first();

        return $this->respondWithToken($user, 'token');
    }
}