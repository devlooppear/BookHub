<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function index()
    {
        try {
            // Retrieve all users
            $users = User::all();

            return response()->json($users);
        } catch (Exception $e) {
            Log::error('Error fetching users: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while fetching users.'], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            // Validate user input
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users|max:255',
                'password' => 'required|string|min:8',
                'role_id' => 'required|exists:roles,id',
            ]);

            // Create a new user
            $user = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
                'role_id' => $validatedData['role_id'],
            ]);

            return response()->json(['message' => 'User created successfully', 'user' => $user], 201);
        } catch (Exception $e) {
            Log::error('Error creating user: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while creating the user.'], 500);
        }
    }

    public function show(User $user)
    {
        try {
            return response()->json($user);
        } catch (Exception $e) {
            Log::error('Error fetching user details: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while fetching user details.'], 500);
        }
    }

    public function update(Request $request, User $user)
    {
        try {
            // Validate and update user details
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $user->id,
                'password' => 'nullable|string|min:8',
                'role_id' => 'required|exists:roles,id',
            ]);

            // Update user information
            $user->update([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => $validatedData['password'] ? Hash::make($validatedData['password']) : $user->password,
                'role_id' => $validatedData['role_id'],
            ]);

            return response()->json(['message' => 'User updated successfully', 'user' => $user]);
        } catch (Exception $e) {
            Log::error('Error updating user: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while updating the user.'], 500);
        }
    }

    public function destroy(User $user)
    {
        try {
            // Delete user
            $user->delete();

            return response()->json(['message' => 'User deleted successfully']);
        } catch (Exception $e) {
            Log::error('Error deleting user: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while deleting the user.'], 500);
        }
    }
}
