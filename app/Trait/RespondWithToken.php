<?php

namespace App\Trait;

trait RespondWithToken
{
    public function respondWithToken($user = 'user not found', $token = 'token not provided')
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user,
        ], 200);
    }
}