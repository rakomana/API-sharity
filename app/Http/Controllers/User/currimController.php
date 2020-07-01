<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Models\Currim;
use App\Models\User;
use App\Models\Media;
use App\Http\Requests\User\UserUpdateRequest;
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
     * @param Currim $curriculum
     * @param Media $media
     * @param User $user
     * @param DB $db
     */
    public function __construct(Currim $curriculum, DB $db, User $user, Media $media) {
        $this->curriculum = $curriculum;
        $this->db = $db;
        $this->user = $user;
        $this->media = $media;

    }

    /**
     * Store a new Curriculum Vitae.
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function store(Request $request)
    {
        if ($request->user()->curriculum) {
            return ResponseBuilder::asError(ResponseCodes::SOMETHING_WENT_WRONG)
                ->withHttpCode(Response::HTTP_BAD_REQUEST)
                ->withMessage("User already has a CV")
                ->build();
        }
        
        $this->db->beginTransaction();
        
        $curriculum =new $this->curriculum();
        $curriculum->full = $request->full;
		$curriculum->save();

        //upload file to s3
        $curriculum->addMedia($request->cc_a)->toMediaCollection('video-cv', 's3');
        
        //associate curriculum  with the user
        $user =$request->user();
        $user->curriculum()->associate($curriculum);
        $user->save();

        $this->db->commit();
        
        return ResponseBuilder::asSuccess()
            ->withHttpCode(Response::HTTP_OK)
            ->withMessage("Curriculum vitae succesfully created")
            ->withData(["Curriculum Vitae" => $curriculum])
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
        $curriculum = $request->user()->curriculum;

        return ResponseBuilder::asSuccess()
            ->withHttpCode(Response::HTTP_OK)
            ->withMessage("Curriculum vitae's succesfully fetched")
            ->withData(["Curriculum Vitae's" => $curriculum, 
                        "Video CV" => $curriculum->getMedia('video-cv')])
            ->build();
    }
 
    /**
     * Update the specified resource in storage.
     *
     * @param UserUpdateRequest $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function update(Request $request)
    {
        $this->db->beginTransaction();
        
        $curriculum = $request->user()->curriculum;
        $curriculum->full = $request->full;
		$curriculum->save();

        $this->db->commit();
        
        return ResponseBuilder::asSuccess()
            ->withHttpCode(Response::HTTP_OK)
            ->withMessage("Curriculum vitae succesfully updated")
            ->withData(["Curriculum Vitae" => $curriculum])
            ->build();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Media $media
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function updateVideoCv(Request $request, Media $media)
    {  
        if($request->user()->curriculum->media)
        {
            return ResponseBuilder::asError(ResponseCodes::SOMETHING_WENT_WRONG)
                ->withHttpCode(Response::HTTP_BAD_REQUEST)
                ->withMessage("User already has a Video-CV")
                ->build();
        }

        $request->user()->curriculum
                 ->addMedia($request->cc_a)
                 ->toMediaCollection('video-cv', 's3');

        return ResponseBuilder::asSuccess()
            ->withHttpCode(Response::HTTP_OK)
            ->withMessage("Video CV succesfully updated")
            ->build();
    }

    /**
     * Remove the specified resource in storage.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function destroyVideoCv(Request $request)
    {
        $curriculum = $request->user()->curriculum;

        $curriculum->clearMediaCollection('video-cv');

        return ResponseBuilder::asSuccess()
            ->withHttpCode(Response::HTTP_OK)
            ->withMessage("Video CV succesfully deleted")
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
        $curriculum = $request->user()->curriculum;

        $curriculum->delete();

        return ResponseBuilder::asSuccess()
            ->withHttpCode(Response::HTTP_OK)
            ->withMessage("Curriculum succesfully deleted")
            ->build();
    }
}
