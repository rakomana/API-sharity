<?php

namespace App\Http\Controllers\User;

use App\Enums\EnumRole;
use App\Enums\ResponseCodes;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserRoleAssignRequest;
use App\Http\Requests\User\UserStoreRequest;
use App\Models\File;
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

class fileUserController extends Controller
{
    private DB $db;
    private File $file;
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
        File $file,
        Permission $permission,
        Role $role,
        RoleOwnership $roleOwnership,
        User $user
    ) {
        $this->db = $db;
        $this->file = $file;
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
        $users = $request->user()->file->users;

        return ResponseBuilder::asSuccess()
            ->withHttpCode(Response::HTTP_OK)
            ->withMessage('All file(s) users fetched successfully')
            ->withData(['users' => $users])
            ->build();
    }

    /**
     * Create a new user for the organization.
     *
     * @param UserStoreRequest $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function store(Request $request, User $user)
    {
        $file = $request->user()->file;

        $user->file()->associate($file);
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
            ->withMessage('User added successfully.')
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
     * Destroy the specified resource in storage.
     *
     * @param User $user
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function destroy(User $user)
    {
        if($user->hasRole(EnumRole::FilePrimaryAdmin)) {
            return ResponseBuilder::asError(404)
                ->withHttpCode(Response::HTTP_BAD_REQUEST)
                ->withMessage('Primary admin cannot be deleted')
                ->build();
        }

        $user->file()->dissociate();

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

        $file = $request->user()->file;

        $role = $this->role->offile($file)->findOrFail($request->role_id);

        $user->syncRoles($role);

        // Disallow two admins in the same organization
        if ($file->users()->primaryAdmins()->count() > 1) {
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
