<?php

namespace App\Http\Controllers\Auth;

use App\Enums\ResponseCodes;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Database\ConnectionInterface as DB;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Requests\User\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use MarcinOrlowski\ResponseBuilder\ResponseBuilder;
use Tymon\JWTAuth\Facades\JWTAuth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    private DB $db;
    private User $user;

    /**
     * Inject models into the constructor.
     *
     * @param DB $db
     * @param TemporaryLogin $temporaryLogin
     * @param User $user
     */
    public function __construct(DB $db, User $user) {
        $this->db = $db;
        $this->user = $user;
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('api_user');
    }

    /**
     * Handle a login request to the application.
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function login(Request $request)
    {
        $credentials = request(['email', 'password']);
        
        if (!$jwtToken = auth('api_user')->attempt($credentials)) {
            return ResponseBuilder::asError(ResponseCodes::SOMETHING_WENT_WRONG)
                ->withHttpCode(Response::HTTP_BAD_REQUEST)
                ->withMessage(trans('auth.failed'))
                ->withData([$this->username() => [trans('auth.failed')]])
                ->build();
        }

        $user = $this->guard()->setToken($jwtToken)->authenticate();

        return ResponseBuilder::asSuccess()
            ->withHttpCode(Response::HTTP_OK)
            ->withMessage(trans('auth.success_temporary'))
            ->withData(['user' => $user, 'jwtToken' => $jwtToken])
            ->build();
    }

    /**
     * Invalidate the user token and log the user out.
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        return ResponseBuilder::asSuccess()
            ->withHttpCode(Response::HTTP_OK)
            ->withMessage('Signed out successfully')
            ->build();
    }
}
