<?php

namespace App\Http\Controllers\User;

use App\Models\File;
use App\Models\Media;
use App\Models\Role;
use App\Models\Permission;
use App\Models\RoleOwnership;
use App\Enums\EnumRole;
use App\Enums\MediaCollections;
use Illuminate\Database\ConnectionInterface as DB;
use Illuminate\Http\Response;
use MarcinOrlowski\ResponseBuilder\ResponseBuilder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\File\FeaturedImageStoreRequest;
use App\Http\Requests\User\File\FileStoreRequest;
use App\Http\Requests\User\File\FileUpdateRequest;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    private DB $db;
    private File $file;
    private Media $media;
    private Role $role;
    private Permission $permission;
    private RoleOwnership $roleOwnership;

    /**
     * Inject models into the constructor.
     *
     * @param Media $media
     * @param File $file
     * @param DB $db
     */
    public function __construct(DB $db, File $file, Media $media, Role $role, Permission $permission, RoleOwnership $roleOwnership) {
        $this->db = $db;
        $this->file = $file;
        $this->media = $media;
        $this->role = $role;
        $this->permission = $permission;
        $this->roleOwnership = $roleOwnership;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $fileData = $request->user()->file;

        return ResponseBuilder::asSuccess()
            ->withHttpCode(Response::HTTP_OK)
            ->withMessage("File(s) succesfully fetched")
            ->withData(["File(s) information" => $fileData])
            ->build();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FileStoreRequest $request)
    {
        $this->db->beginTransaction();

        //upload to s3
        $file_data =Storage::cloud()->put('files/', $request->file('file'));

        $file = new $this->file;
        $file->title = $request->title;
        $file->description = $request->description;
        $file->duration = $request->duration;
        $file->file = $file_data;
        $file->size = $request->file('file')->getSize();
        $file->save();

        $user = $request->user();
        $user->file()->associate($file);
        $user->save();

        $role = new $this->role();
        $role->name =EnumRole::FilePrimaryAdmin;
        $role->save();

        $permission = $this->permission->where('guard_name','api_user')->get();
        $role->permissions()->sync($permission);

        $roleOwnership = new $this->roleOwnership();
        $roleOwnership->role()->associate($role);
        $roleOwnership->owner()->associate($file);
        $roleOwnership->save();

        // Attach the user to the role
        $request->user()->roles()->sync($role);

        $this->db->commit();


        return ResponseBuilder::asSuccess()
            ->withHttpCode(Response::HTTP_OK)
            ->withMessage("File(s) succesfully created")
            ->withData(["File(s)" => $file])
            ->build();
    }

        /**
     * Update specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(FileUpdateRequest $request)
    {
        $this->db->beginTransaction();

        $file = $request->user()->file;
        $file->title = $request->title;
        $file->description = $request->description;
        $file->duration = $request->duration;
        $file->save();

        $this->db->commit();


        return ResponseBuilder::asSuccess()
            ->withHttpCode(Response::HTTP_OK)
            ->withMessage("File(s) succesfully updated")
            ->withData(["File(s)" => $file])
            ->build();
    }

     /**
     * displayy the specified resource from storage.
     *
     * @param  \App\file  $file
     * @return \Illuminate\Http\Response
     */
     public function indexFeaturedImage(Request $request)
     {
         $file = $request->user()->file;
         $file->getMedia(MediaCollections::FeaturedImage);
 
         return ResponseBuilder::asSuccess()
             ->withHttpCode(Response::HTTP_OK)
             ->withMessage("File featured image succesfully fetched")
             ->withData(["File(s)" => $file])
             ->build();
     }

    /**
     * store the specified resource from storage.
     *
     * @param  \App\file  $file
     * @return \Illuminate\Http\Response
     */
    public function storeFeaturedImage(FeaturedImageStoreRequest $request)
    {
        $file = $request->user()->file;
        $file->addMedia($request->file('featured_image'))
            ->toMediaCollection(MediaCollections::FeaturedImage);

        return ResponseBuilder::asSuccess()
            ->withHttpCode(Response::HTTP_OK)
            ->withMessage("File featured image succesfully stored")
            ->withData(["File(s)" => $file])
            ->build();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\file  $file
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, String $data)
    {
        Storage::disk('s3')->delete('files/' . $data);
        $file = $request->user()->file;
        $file->delete();

        return ResponseBuilder::asSuccess()
            ->withHttpCode(Response::HTTP_OK)
            ->withMessage("File(s) succesfully deleted")
            ->build();
    }
}
