<?php

namespace App\Http\Controllers\User;

use App\Enums\EnumRole;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserRoleAssignRequest;
use App\Http\Requests\User\UserStoreRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Models\Company;
use App\Models\Permission;
use App\Models\Role;
use App\Models\RoleOwnership;
use App\Models\User;
use Illuminate\Database\ConnectionInterface as DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use MarcinOrlowski\ResponseBuilder\ResponseBuilder;

class CompanyUserController extends Controller
{
    private DB $db;
    private Company $company;
    private Permission $permission;
    private Role $role;
    private RoleOwnership $roleOwnership;
    private User $user;

    /**
     * Inject models into the constructor.
     *
     * @param DB $db
     * @param Organization $organization
     * @param Permission $permission
     * @param Role $role
     * @param RoleOwnership $roleOwnership
     * @param User $user
     */
    public function __construct(
        DB $db,
        Company $company,
        Permission $permission,
        Role $role,
        RoleOwnership $roleOwnership,
        User $user
    ) {
        $this->db = $db;
        $this->company = $company;
        $this->permission = $permission;
        $this->role = $role;
        $this->roleOwnership = $roleOwnership;
        $this->user = $user;
    }

    /**
     * Get all the users of the organization.
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(Request $request)
    {
        $users = $request->user()->company->users;

        return ResponseBuilder::asSuccess()
            ->withHttpCode(Response::HTTP_OK)
            ->withMessage('Company users fetched successfully')
            ->withData(['users' => $users])
            ->build();
    }

    /**
     * Create a new user for the organization.
     *
     * @param UserStoreRequest $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function store(UserStoreRequest $request)
    {
        $this->db->beginTransaction();

        $company = $request->user()->company;

        // Generates password for user
        $generatedPassword = Str::random(8);

        $user = new $this->user();
        $user->company()->associate($company);
        $user->full_name = $request->full_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = Hash::make($generatedPassword);
        $user->save();

        // Send welcome notification to user
        /*$user->notify(new Welcome(
            $request->callbackUrl,
            $organization,
            $generatedPassword
        ));*/

        $this->db->commit();

        return ResponseBuilder::asSuccess()
            ->withHttpCode(Response::HTTP_CREATED)
            ->withMessage('User created successfully.')
            ->withData(['user' => $user])
            ->build();
    }

    /**
     * Display a specified resource.
     *
     * @param User $user
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function show(User $user)
    {
        $user = $user->load('roles');

        return ResponseBuilder::asSuccess()
            ->withHttpCode(Response::HTTP_OK)
            ->withMessage('User fetched successfully.')
            ->withData(['user' => $user])
            ->build();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProfileUpdateRequest $request
     * @param User $user
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        $this->db->beginTransaction();

        if($user->hasRole(EnumRole::CompanyPrimaryAdmin)) {
            return ResponseBuilder::asError(404)
                ->withHttpCode(Response::HTTP_BAD_REQUEST)
                ->withMessage('Primary admin cannot be edited')
                ->build();
        }

        $user->full_name = $request->full_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;

        /*if ($user->isDirty('email')) {
            $user->email_verified_at = null;
            $user->sendEmailVerificationNotification();
        }*/

        $user->save();

        $this->db->commit();

        return ResponseBuilder::asSuccess()
            ->withHttpCode(Response::HTTP_OK)
            ->withMessage('User updated successfully')
            ->withData(['user' => $user])
            ->build();
    }

    /**
     * Destroy the specified resource in storage.
     *
     * @param User $user
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function destroy(User $user)
    {
        if($user->hasRole(EnumRole::CompanyPrimaryAdmin)) {
            return ResponseBuilder::asError(404)
                ->withHttpCode(Response::HTTP_BAD_REQUEST)
                ->withMessage('Primary admin cannot be deleted')
                ->build();
        }

        $user->delete();

        return ResponseBuilder::asSuccess()
            ->withHttpCode(Response::HTTP_OK)
            ->withMessage('User deleted successfully')
            ->build();
    }

    /**
     * Assign role to user.
     *
     * @param UserRoleAssignRequest $request
     * @param User $user
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function assignRole(UserRoleAssignRequest $request, User $user)
    {
        $this->db->beginTransaction();

        $company = $request->user()->company;

        $role = $this->role->ofCompany($company)->findOrFail($request->role_id);

        $user->syncRoles($role);

        // Disallow two admins in the same organization
        if ($company->users()->primaryAdmins()->count() > 1) {
            return ResponseBuilder::asError(404)
                ->withMessage('Multiple primary admins not allowed')
                ->build();
        }

        $this->db->commit();

        return ResponseBuilder::asSuccess()
            ->withHttpCode(Response::HTTP_OK)
            ->withMessage('Role assigned to user successfully')
            ->withData(['user' => $user])
            ->build();
    }
}
