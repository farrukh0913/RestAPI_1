<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * @OA\Get(
 *     path="/users",
 *     summary="Get example data",
 *     @OA\Response(response="200", description="Successful operation"),
 * )
 */
class UserController extends Controller
{

    public function getUsers()
    {
        $data = [
            'message' => 1,
            'body' => 'message from laravel',
        ];

        // Return a JSON response
        return response()->json($data);
    }
}
