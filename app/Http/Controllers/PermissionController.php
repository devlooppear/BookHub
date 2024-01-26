<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PermissionController extends Controller
{
    /**
     * Display a listing of the permissions.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $permissions = Permission::orderBy('id', 'asc')->get();
            return response()->json($permissions);
        } catch (Exception $e) {
            Log::error('Error fetching permissions: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while fetching permissions: ' . $e->getMessage()]);
        }
    }

    /**
     * Store a newly created permission in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|unique:permissions',
            ]);

            $permission = Permission::create($request->all());

            return response()->json($permission, 201);
        } catch (Exception $e) {
            Log::error('Error storing permission: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while storing the permission: ' . $e->getMessage()]);
        }
    }

    /**
     * Display the specified permission.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission)
    {
        try {
            return response()->json($permission);
        } catch (Exception $e) {
            Log::error('Error fetching permission details: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while fetching permission details: ' . $e->getMessage()]);
        }
    }

    /**
     * Update the specified permission in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
        try {
            $request->validate([
                'name' => 'string|unique:permissions',
            ]);

            $permission->update($request->all());

            return response()->json($permission, 200);
        } catch (Exception $e) {
            Log::error('Error updating permission: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while updating the permission: ' . $e->getMessage()]);
        }
    }
    /**
     * Remove the specified permission from storage.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        try {
            $permission->delete();
            return response()->json(null, 204);
        } catch (Exception $e) {
            Log::error('Error deleting permission: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while deleting the permission: ' . $e->getMessage()]);
        }
    }
}
