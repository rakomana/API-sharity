<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Media;
use Illuminate\Database\ConnectionInterface as DB;
use Illuminate\Http\Response;
use MarcinOrlowski\ResponseBuilder\ResponseBuilder;



class currimController extends Controller
{
    private Currim $curriculum;
    private Media $media;
    private User $user;
    private DB $db;

    /**
     * Inject models into the constructor.
     *
     * @param Media $media
     * @param User $user
     * @param DB $db
     */
    public function __construct(DB $db, User $user, Media $media) {
        $this->db = $db;
        $this->user = $user;
        $this->media = $media;

    }

    /**
     * Show specific resource in storage.
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function show(Request $request)
    {
        return ResponseBuilder::asSuccess()
            ->withHttpCode(Response::HTTP_OK)
            ->withMessage("The user if fetched succesfully created")
            ->withData(["User Details" => $request->user()])
            ->build();
    }

    /**
     * Update the specified resource.
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function update(Request $request)
    {
        $this->db->beginTransaction();

        $user = $request->user();
        $user->full_name = $request->full_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->save();

        if($user->isDirty('email')){
            //send email verification
        }

        $this->db->commit();

        return ResponseBuilder::asSuccess()
            ->withHttpCode(Response::HTTP_OK)
            ->withMessage("The user is succesfully updated")
            ->withData(["User" => $user])
            ->build();
    }
 
    /**
     * Update the specified resource in storage.
     *
     * @param UserUpdateRequest $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function logs(Request $request)
    {
        $user = $request->user()->logs;
       
        return ResponseBuilder::asSuccess()
            ->withHttpCode(Response::HTTP_OK)
            ->withMessage("User logs succesfully fetched")
            ->withData(["User's logs" => $user])
            ->build();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Media $media
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function updateProfilePicture(Request $request, Media $media)
    {
        $user = $request->user();

        //update profile picture

        return ResponseBuilder::asSuccess()
            ->withHttpCode(Response::HTTP_OK)
            ->withMessage("User profile picture succesfully updated")
            ->build();
    }

    /**
     * update the specified resource in storage.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function updatePassword(Request $request)
    {
        //update the password
        $this->db->beginTransaction();

        $user = $request->user();
        $user->password = $request->password; //
        $user->save();

        //Notify the user about password change via email
        $this->db->commit();

        return ResponseBuilder::asSuccess()
            ->withHttpCode(Response::HTTP_OK)
            ->withMessage("User password updated succesfully")
            ->build();
    }

    /**
     * Remove the specified resource in storage.
     *
     * @param OrganizationUpdateRequest $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function destroy(Request $request)
    {
        $user= $request->user();

        $user->delete();

        return ResponseBuilder::asSuccess()
            ->withHttpCode(Response::HTTP_OK)
            ->withMessage("User succesfully deleted")
            ->build();
    }
}
