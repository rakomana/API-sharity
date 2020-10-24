<?php

namespace App\Http\Controllers\User;


use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Media;
use App\Models\Role;
use App\Models\Permission;
use App\Models\RoleOwnership;
use App\Enums\MediaCollections;
use App\Enums\EnumRole;
use App\Enums\ResponseCodes;
use App\Enums\VerificationStatus;
use Illuminate\Database\ConnectionInterface as DB;
use Illuminate\Http\Response;
use MarcinOrlowski\ResponseBuilder\ResponseBuilder;
use App\Http\Requests\User\Company\CompanyUpdateRequest;
use App\Http\Requests\User\Company\CompanyStoreRequest;
use App\Http\Requests\User\Company\CompanyLogoUpdateRequest;
use App\Http\Requests\User\Company\CompanyDocumentStoreRequest;
use Illuminate\Http\Request;


class CompaniesController extends Controller
{
    private DB $db;
    private Company $company;
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
    public function __construct(DB $db, Company $company, Media $media, Role $role, Permission $permission, RoleOwnership $roleOwnership) {
        $this->db = $db;
        $this->company = $company;
        $this->media = $media;
        $this->role = $role;
        $this->permission = $permission;
        $this->roleOwnership = $roleOwnership;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     $user = $request-er();
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyStoreRequest $request)
    {
        if ($request->user()->company) {
            return ResponseBuilder::asError(ResponseCodes::SOMETHING_WENT_WRONG)
                ->withHttpCode(Response::HTTP_BAD_REQUEST)
                ->withMessage('User already belongs to a company')
                ->build();
        }

        $this->db->beginTransaction();
  
        $company = new $this->company();
        $company->company_name = $request->company_name;
        $company->description = $request->description;
        $company->phone_number = $request->phone_number;
        $company->category = $request->category;
        $company->website = $request->website;
        $company->email = $request->email;
        $company->status = 'null';//temporary set defaualt
        $company->save();

        $user = $request->user();
        $user->company()->associate($company);
        $user->save();

        $role = new $this->role();
        $role->name =EnumRole::CompanyPrimaryAdmin;
        $role->save();

        $permission = $this->permission->where('guard_name','api_user')->get(); 
        $role->permissions()->sync($permission);
        
        $roleOwnership = new $this->roleOwnership();
        $roleOwnership->role()->associate($role);
        $roleOwnership->owner()->associate($company);
        $roleOwnership->save();

        // Attach the user to the role
        $request->user()->roles()->sync($role);
        
        $this->db->commit();

        return ResponseBuilder::asSuccess()
            ->withHttpCode(Response::HTTP_OK)
            ->withMessage("Company succesfully registered")
            ->withData(["Company" => $company])
            ->build();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Company  $Company
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $company = $request->user()->company;

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
     * @param  \App\Company  $Company
     * @return \Illuminate\Http\Response
     */
    public function update(CompanyUpdateRequest $request)
    {
        $this->db->beginTransaction();

        $company = $request->user()->company;
        $company->company_name = $request->company_name;
        $company->description = $request->description;
        $company->phone_number = $request->phone_number;
        $company->category = $request->category;
        $company->website = $request->website;
        $company->email = $request->email;
        $company->save();

        $this->db->commit();

        return ResponseBuilder::asSuccess()
            ->withHttpCode(Response::HTTP_OK)
            ->withMessage("Company succesfully updated")
            ->withData(["Company" => $company])
            ->build();
    }

    /**
     * display the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Company  $Company
     * @return \Illuminate\Http\Response
     */
    public function indexDocuments(Request $request)
    {
        $company = $request->user()->company;
        $company->getMedia(MediaCollections::CompanyDocuments);

        return ResponseBuilder::asSuccess()
            ->withHttpCode(Response::HTTP_OK)
            ->withMessage("Company documents succesfully fetched")
            ->withData(["Company" => $company])
            ->build();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Company  $Company
     * @return \Illuminate\Http\Response
     */
    public function storeDocuments(CompanyDocumentStoreRequest $request)
    {
        $this->db->beginTransaction();

        $company = $request->user()->company;
        $company->status = VerificationStatus::Pending;
        $company->addMultipleMediaFromRequest(['company_documents'])
            ->each(fn ($fileAdder) => $fileAdder
            ->toMediaCollection(MediaCollections::CompanyDocuments));
        $company->save();

        $this->db->commit();

        return ResponseBuilder::asSuccess()
            ->withHttpCode(Response::HTTP_OK)
            ->withMessage("Company documents succesfully stored")
            ->build();
    }

    /**
     * display the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Company  $Company
     * @return \Illuminate\Http\Response
     */
    public function indexCompanyLogo(Request $request)
    {
        $company = $request->user()->company;
        $company->getMedia(MediaCollections::Logo);

        return ResponseBuilder::asSuccess()
            ->withHttpCode(Response::HTTP_OK)
            ->withMessage("Company logo succesfully fetched")
            ->withData(["Company" => $company])
            ->build();
    }
    /**
     * store the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Company  $Company
     * @return \Illuminate\Http\Response
     */
    public function updateCompanyLogo(CompanyLogoUpdateRequest $request)
    {
        $company = $request->user()->company;
        $company->addMedia($request->file('logo'))
            ->toMediaCollection(MediaCollections::Logo);

        return ResponseBuilder::asSuccess()
            ->withHttpCode(Response::HTTP_OK)
            ->withMessage("Company logo succesfully updated")
            ->build();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Company  $Company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $company = $request->user()->company;
        $company->delete();

        return ResponseBuilder::asSuccess()
            ->withHttpCode(Response::HTTP_OK)
            ->withMessage("Company succesfully deleted")
            ->build();
    }
}
