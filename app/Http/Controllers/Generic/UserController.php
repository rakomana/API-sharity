<?php

namespace App\Http\Controllers\Generic;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Database\ConnectionInterface as DB;
use MarcinOrlowski\ResponseBuilder\ResponseBuilder;

class UserController extends Controller
{
    private $user;
    private $db;

    /**
     * Inject models into the constructor.
     *
     * @param User $user
     * @param DB $db
     */
    public function __construct(DB $db, User $user) {
        $this->db = $db;
        $this->user = $user;
    }

    /**
     * Show all resource in storage.
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        return ResponseBuilder::asSuccess()
            ->withHttpCode(Response::HTTP_OK)
            ->withMessage("All users fetched succesfully")
            ->withData(["users" => $this->user->all()])
            ->build();
    }

    /**
     * Show specific resource in storage.
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function show(User $user)
    {
        return ResponseBuilder::asSuccess()
            ->withHttpCode(Response::HTTP_OK)
            ->withMessage("All users fetched succesfully")
            ->withData(['user' => $user])
            ->build();
    }
}
