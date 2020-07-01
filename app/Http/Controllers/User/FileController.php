<?php

namespace App\Http\Controllers\User;

use App\Models\File;
use App\Models\Media;
use App\Http\Requests\User\UserUpdateRequest;
use Illuminate\Database\ConnectionInterface as DB;
use Illuminate\Http\Response;
use MarcinOrlowski\ResponseBuilder\ResponseBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    private DB $db;
    private File $file;
    private Media $media;

    /**
     * Inject models into the constructor.
     *
     * @param Media $media
     * @param File $file
     * @param DB $db
     */
    public function __construct(DB $db, File $file, Media $media) {
        $this->db = $db;
        $this->file = $file;
        $this->media = $media;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $url = 'https://s3.' . env('AWS_DEFAULT_REGION') . '.amazonaws.com/' . env('AWS_BUCKET') . '/';
        $data = [];
        $files = Storage::disk('s3')->files('images');
            foreach ($files as $file) {
                $data[] = [
                    'name' => str_replace('files/', '', $file),
                    'src' => $url . $file
                ];
            }

        return ResponseBuilder::asSuccess()
            ->withHttpCode(Response::HTTP_OK)
            ->withMessage("File(s) succesfully fetched")
            ->withData(["File(s)" => $data])
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
        $this->db->beginTransaction();

        $file = new $this->file;
        $file->title = $request->title;
        $file->description = $request->description;
        $file->duration = $request->duration;

        //upload to s3
        $data = $request->file('image');
        $name = time() . $file->getClientOriginalName();
        $filePath = 'files/' . $name;
        Storage::disk('s3')->put($filePath, file_get_contents($data));

        $file->file = $name;
        $file->save();

        $user = $request->user();
        $user->file()->associate($file);

        $this->db->commit();

        return ResponseBuilder::asSuccess()
            ->withHttpCode(Response::HTTP_OK)
            ->withMessage("File(s) succesfully created")
            ->withData(["File(s)" => $file])
            ->build();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\file  $file
     * @return \Illuminate\Http\Response
     */
    public function destroy($data)
    {
        Storage::disk('s3')->delete('files/' . $data);

        return ResponseBuilder::asSuccess()
            ->withHttpCode(Response::HTTP_OK)
            ->withMessage("File(s) succesfully deleted")
            ->withData(["File(s)" => $file])
            ->build();
    }
}
