<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Media;
use App\Http\Requests\User\UserUpdateRequest;
use Illuminate\Database\ConnectionInterface as DB;
use Illuminate\Http\Response;
use MarcinOrlowski\ResponseBuilder\ResponseBuilder;



class PostLikesController extends Controller
{
    private Post post;
    private Media $media;
    private User $user;
    private DB $db;

    /**
     * Inject models into the constructor.
     *
     * @param Post post
     * @param Media $media
     * @param User $user
     * @param DB $db
     */
    public function __construct(Post post, DB $db, User $user, Media $media) {
        $this->post = post;
        $this->db = $db;
        $this->user = $user;
        $this->media = $media;

    }

    /**
     * Store a new post Vitae.
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function store(Request $request)
    {
        return ResponseBuilder::asSuccess()
            ->withHttpCode(Response::HTTP_OK)
            ->withMessage("post like succesfully created")
            ->withData(["post like" => $post])
            ->build();
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function show(Request $request)
    {
        return ResponseBuilder::asSuccess()
            ->withHttpCode(Response::HTTP_OK)
            ->withMessage("post like succesfully fetched")
            ->withData(["post like" => $post])
            ->build();
    }
 
    /**
     * Show the specified resource in storage.
     *
     * @param UserUpdateRequest $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(Request $request)
    {
        return ResponseBuilder::asSuccess()
            ->withHttpCode(Response::HTTP_OK)
            ->withMessage("post likes succesfully updated")
            ->withData(["post like" => $post])
            ->build();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Media $media
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function update(Request $request)
    {
        return ResponseBuilder::asSuccess()
            ->withHttpCode(Response::HTTP_OK)
            ->withMessage("post like successfully updated")
            ->build();
    }

    /**
     * Remove the specified resource in storage.
     *
     * @param likeUpdateRequest $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function destroy(Request $request)
    {
        return ResponseBuilder::asSuccess()
            ->withHttpCode(Response::HTTP_OK)
            ->withMessage("post like succesfully deleted")
            ->build();
    }
}
