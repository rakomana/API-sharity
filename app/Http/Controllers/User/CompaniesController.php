<?php

namespace App\Http\Controllers;

use App\Models\Companies;
use Illuminate\Http\Request;
use App\Models\Media;
use App\Http\Requests\User\UserUpdateRequest;
use Illuminate\Database\ConnectionInterface as DB;
use Illuminate\Http\Response;
use MarcinOrlowski\ResponseBuilder\ResponseBuilder;
use Illuminate\Http\Request;


class CompaniesController extends Controller
{
    private DB $db;
    private Media $media;
    private Companies $company;

    /**
     * Inject models into the constructor.
     *
     * @param Media $media
     * @param Companies $company
     * @param DB $db
     */
    public function _constructor(DB $db, Media $media, Companies $company)
    {
        $this->db = $db;
        $this->company = $company;
        $this->media = $media;

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
            ->withMessage("Company succesfully registered")
            ->withData(["Company" => $company])
            ->build();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Companies  $companies
     * @return \Illuminate\Http\Response
     */
    public function show(Companies $companies)
    {
        return ResponseBuilder::asSuccess()
            ->withHttpCode(Response::HTTP_OK)
            ->withMessage("Company succesfully fetched")
            ->withData(["Company" => $company])
            ->build();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Companies  $companies
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Companies $companies)
    {
        return ResponseBuilder::asSuccess()
            ->withHttpCode(Response::HTTP_OK)
            ->withMessage("Company succesfully updated")
            ->withData(["Company" => $company])
            ->build();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Companies  $companies
     * @return \Illuminate\Http\Response
     */
    public function destroy(Companies $companies)
    {
        return ResponseBuilder::asSuccess()
            ->withHttpCode(Response::HTTP_OK)
            ->withMessage("Company succesfully deleted")
            ->withData(["Company" => $company])
            ->build();
    }
}
