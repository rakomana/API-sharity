<?php

namespace App\Http\Controllers\User;

use App\Models\Post;
use App\Models\Media;
use App\Http\Requests\User\UserUpdateRequest;
use App\Http\Controllers\Controller;
use Illuminate\Database\ConnectionInterface as DB;
use Illuminate\Http\Response;
use MarcinOrlowski\ResponseBuilder\ResponseBuilder;
use Illuminate\Http\Request;

class PostController extends Controller
{
    private DB $db;
    private Post $post;
    private Media $media;

    /**
     * Inject models into the constructor.
     *
     * @param Media $media
     * @param Post $post
     * @param DB $db
     */
    public function __construct(DB $db, Post $post, Media $media) {
        $this->db = $db;
        $this->post = $post;
        $this->media = $media;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ResponseBuilder::asSuccess()
            ->withHttpCode(Response::HTTP_OK)
            ->withMessage("Post(s) succesfully fetched")
            ->withData(["Post(s)" => $post])
            ->build();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return ResponseBuilder::asSuccess()
            ->withHttpCode(Response::HTTP_OK)
            ->withMessage("Post(s) succesfully created")
            ->withData(["Post(s)" => $post])
            ->build();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return ResponseBuilder::asSuccess()
            ->withHttpCode(Response::HTTP_OK)
            ->withMessage("Post(s) succesfully fetched")
            ->withData(["Post(s)" => $post])
            ->build();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Post $post)
    {
        return ResponseBuilder::asSuccess()
            ->withHttpCode(Response::HTTP_OK)
            ->withMessage("Post(s) succesfully updated")
            ->withData(["Post(s)" => $post])
            ->build();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        return ResponseBuilder::asSuccess()
            ->withHttpCode(Response::HTTP_OK)
            ->withMessage("Post(s) succesfully deleted")
            ->withData(["Post(s)" => $post])
            ->build();
    }
}
