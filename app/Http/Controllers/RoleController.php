<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class RoleController extends Controller
{
    /**
     * Display a listing of the roles.
     *
     * @return Response
     */
    public function index()
    {
        try {
            $roles = Role::all()
            ->orderBy('id','asc');
            return response()->json($roles);
        } catch (Exception $e) {
            Log::error('Error fetching roles: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while fetching roles: ' . $e->getMessage()]);
        }
    }

    /**
     * Store a newly created role in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|numeric',
                'name' => 'required|string|unique:roles',
            ]);

            $role = Role::create($request->all());

            return response()->json($role, 201);
        } catch (Exception $e) {
            Log::error('Error storing role: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while storing the role: ' . $e->getMessage()]);
        }
    }

    /**
     * Display the specified role.
     *
     * @param  Role  $role
     * @return Response
     */
    public function show(Role $role)
    {
        try {
            return response()->json($role);
        } catch (Exception $e) {
            Log::error('Error fetching role details: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while fetching role details: ' . $e->getMessage()]);
        }
    }

    /**
     * Update the specified role in storage.
     *
     * @param  Request  $request
     * @param  Role  $role
     * @return Response
     */
    public function update(Request $request, Role $role)
    {
        try {
            $request->validate([
                'name' => 'string|unique:roles,name,' . $role->id,
            ]);

            $role->update($request->all());

            return response()->json($role, 200);
        } catch (Exception $e) {
            Log::error('Error updating role: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while updating the role: ' . $e->getMessage()]);
        }
    }



    /**
     * Remove the specified role from storage.
     *
     * @param  Role  $role
     * @return Response
     */
    public function destroy(Role $role)
    {
        try {
            $role->delete();
            return response()->json(null, 204);
        } catch (Exception $e) {
            Log::error('Error deleting role: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while deleting the role: ' . $e->getMessage()]);
        }
    }
}
