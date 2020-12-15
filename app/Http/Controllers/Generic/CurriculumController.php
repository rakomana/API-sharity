<?php

namespace App\Http\Controllers\Generic;

use Illuminate\Http\Request;
use App\Models\Currim;
use App\Models\User;
use App\Models\Media;
use App\Enums\ResponseCodes;
use App\Enums\MediaCollections;
use Illuminate\Database\ConnectionInterface as DB;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use MarcinOrlowski\ResponseBuilder\ResponseBuilder;



class CurriculumController extends Controller
{
    private Currim $curriculum;
    private $user;
    private DB $db;

    /**
     * Inject models into the constructor.
     *
     * @param Currim $curriculum
     * @param User $user
     * @param DB $db
     */
    public function __construct(Currim $curriculum, User $user, DB $db) {
        $this->curriculum = $curriculum;
        $this->user = $user;
        $this->db = $db;

    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(Request $request)
    {
        $curriculum = $this->user->curriculum->all();

        return ResponseBuilder::asSuccess()
            ->withHttpCode(Response::HTTP_OK)
            ->withMessage("Curriculum vitae's succesfully fetched")
            ->withData(["curriculum" => $curriculum, 
                        "video" => $curriculum->getMedia(MediaCollections::VideoCurriculum)])
            ->build();
    }
 }
