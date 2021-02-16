<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Models\Currim;
use App\Models\User;
use App\Models\Media;
use App\Enums\ResponseCodes;
use App\Enums\MediaCollections;
use App\Http\Requests\User\Curriculum\CurriculumStoreRequest;
use App\Http\Requests\User\Curriculum\CurriculumUpdateRequest;
use Illuminate\Database\ConnectionInterface as DB;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
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
    public function store(CurriculumStoreRequest $request)
    {
        
        if ($request->user()->curriculum) {
            return ResponseBuilder::asError(ResponseCodes::SOMETHING_WENT_WRONG)
                ->withHttpCode(Response::HTTP_BAD_REQUEST)
                ->withMessage("User already has a CV")
                ->build();
        }
        
        $this->db->beginTransaction();
        
        $curriculum =new $this->curriculum();
        $curriculum->id_or_passport = $request->id_or_passport;
        $curriculum->nationality = $request->nationality;
        $curriculum->gender = $request->gender;
        $curriculum->languages = $request->languages;
        $curriculum->physical_address = $request->physical_address;
        $curriculum->category = $request->category;
        $curriculum->languages = $request->languages;
        $curriculum->phone_number = $request->phone_number;
		$curriculum->save();
        
        //upload file to s3
        /*
        $curriculum->addMedia($request->file('video'))
                    ->toMediaCollection(MediaCollections::VideoCurriculum, 's3');*/
        
        //associate curriculum  with the user
        $user =$request->user();
        $user->curriculum()->associate($curriculum);
        $user->save();

        $this->db->commit();
        
        return ResponseBuilder::asSuccess()
            ->withHttpCode(Response::HTTP_OK)
            ->withMessage("Curriculum vitae succesfully created")
            ->withData(["curriculum" => $curriculum])
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

        if(!$curriculum)
        {
            return ResponseBuilder::asSuccess()
                ->withHttpCode(Response::HTTP_OK)
                ->withMessage("User doesn't have the curriculum")
                ->build();
        }
        
        return ResponseBuilder::asSuccess()
            ->withHttpCode(Response::HTTP_OK)
            ->withMessage("Curriculum vitae's succesfully fetched")
            ->withData(["curriculum" => $curriculum, 
                        "video" => $curriculum->getMedia(MediaCollections::VideoCurriculum)])
            ->build();
    }
 
    /**
     * Update the specified resource in storage.
     *
     * @param UserUpdateRequest $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function update(CurriculumUpdateRequest $request)
    {
        $this->db->beginTransaction();
        
        $curriculum = $request->user()->curriculum;
        $curriculum->id_or_passport = $request->id_or_passport;
        $curriculum->nationality = $request->nationality;
        $curriculum->gender = $request->gender;
        $curriculum->languages = $request->languages;
        $curriculum->physical_address = $request->physical_address;
        $curriculum->category = $request->category;
        $curriculum->phone_number = $request->phone_number;
        $curriculum->documents = $request->documents;//rm
        $curriculum->video = $request->video;//rm
		$curriculum->save();

        $this->db->commit();
        
        return ResponseBuilder::asSuccess()
            ->withHttpCode(Response::HTTP_OK)
            ->withMessage("Curriculum vitae succesfully updated")
            ->withData(["curriculum" => $curriculum])
            ->build();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Media $media
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function updateVideoCv(Request $request)
    {  
        if(count($request->user()->curriculum->media) > 0)
        {
            return ResponseBuilder::asError(ResponseCodes::SOMETHING_WENT_WRONG)
                ->withHttpCode(Response::HTTP_BAD_REQUEST)
                ->withMessage("User already has a Video-CV")
                ->withData(["curriculum" => $request->user()->curriculum->media])
                ->build();
        }

        $request->user()->curriculum
                 ->addMedia($request->file('cc_a'))
                 ->toMediaCollection(MediaCollections::VideoCurriculum, 's3');

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

        $curriculum->clearMediaCollection(MediaCollections::VideoCurriculum);

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
