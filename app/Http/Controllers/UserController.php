<?php

namespace App\Http\Controllers;

use App\Models\PersonalAccessToken;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Services\PersonalAccessTokenService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Laravel\Passport\Token;

class UserController extends Controller
{
    protected $userRepository;
    protected $tokenService;

    public function __construct(UserRepository $userRepository, PersonalAccessTokenService $tokenService)
    {
        $this->userRepository = $userRepository;
        $this->tokenService = $tokenService;
    }

    public function index()
    {
        try {
            $users = User::with(['role', 'books'])->get();
            return response()->json($users);
        } catch (Exception $e) {
            Log::error('Error fetching users: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while fetching users: ' . $e->getMessage()]);
        }
    }


    public function store(Request $request)
    {
        try {
            
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users|max:255',
                'password' => 'required|string|min:8',
                'role_id' => 'required|exists:roles,id',
            ]);

            $user = $this->userRepository->create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
                'role_id' => $validatedData['role_id'],
            ]);

            $tokenData = [
                'token' => $user->createToken('API')->accessToken,
                'user_id' => $user->id,
                'tokenable_type' => get_class($user),
                'tokenable_id' => $user->id,
                'name' => 'API',
            ];

            $this->tokenService->createToken($tokenData);

            return response()->json(['message' => 'User created successfully', 'user' => $user], 201);
        } catch (Exception $e) {
            Log::error('Error creating user: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while creating the user: ' . $e->getMessage()]);
        }
    }

    public function show(User $user)
    {
        try {
            return response()->json($user);
        } catch (Exception $e) {
            Log::error('Error fetching user details: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while fetching user details: ' . $e->getMessage()]);
        }
    }

    public function update(Request $request, User $user)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $user->id,
                'password' => 'nullable|string|min:8',
                'role_id' => 'required|exists:roles,id',
            ]);

            $user->update([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => $validatedData['password'] ? Hash::make($validatedData['password']) : $user->password,
                'role_id' => $validatedData['role_id'],
            ]);

            return response()->json(['message' => 'User updated successfully', 'user' => $user]);
        } catch (Exception $e) {
            Log::error('Error updating user: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while updating the user: ' . $e->getMessage()]);
        }
    }

    public function destroy(User $user)
    {
        try {
            $user->delete();
            return response()->json(['message' => 'User deleted successfully']);
        } catch (Exception $e) {
            Log::error('Error deleting user: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while deleting the user: ' . $e->getMessage()]);
        }
    }
}
