<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TokenController extends Controller
{
    public function token(Request $request)
    {
        $sentence = $request->input('sentence');

        $tokens = preg_split('/\s+/', $sentence, -1, PREG_SPLIT_NO_EMPTY);

        $tokenInfo = [];

        foreach ($tokens as $token) {
            $tokenInfo[] = [
                'token' => $token,
                'length' => strlen($token),
                'is_alphanumeric' => ctype_alnum($token),
                'is_digit' => ctype_digit($token),
                'is_punctuation' => preg_match('/[^\w\s]/', $token),
                'is_lowercase' => ctype_lower($token),
                'is_uppercase' => ctype_upper($token),
            ];
        }

        return response()->json($tokenInfo);
    }
}
