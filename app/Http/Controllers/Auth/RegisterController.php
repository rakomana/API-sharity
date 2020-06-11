<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\RegisterRequest;
use App\User;
use Illuminate\Database\ConnectionInterface as DB;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use MarcinOrlowski\ResponseBuilder\ResponseBuilder;
use Tymon\JWTAuth\Facades\JWTAuth;

class RegisterController extends Controller
{
    private DB $db;
    private User $user;

    /**
     * Inject models into the constructor.
     *
     * @param DB $db
     * @param User $user
     */
    public function __construct(
        DB $db,
        User $user
    ) {
        $this->db = $db;
        $this->user = $user;
    }

    /**
     * Register a new user .
     *
     * @param RegisterRequest $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function register(RegisterRequest $request)
    {
        $this->db->beginTransaction();

        // Create the user
        $user = new $this->user();
        $user->name = $request->name;
        $user->lname = $request->lname;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->type = $request->type; //enum  for user type
        $user->password = Hash::make($request->password);
        $user->save();

        //profile picture that goes along with the model via media library

        // Log user in automatically
        $jwtToken = JWTAuth::claims(['two_fa' => true])->fromUser($user);

        // Send email verification notification
        $user->sendEmailVerificationNotification();

        $this->db->commit();

        return ResponseBuilder::asSuccess()
            ->withHttpCode(Response::HTTP_CREATED)
            ->withMessage('User created successfully')
            ->withData(['user' => $user, 'jwtToken' => $jwtToken])
            ->build();
    }
}
