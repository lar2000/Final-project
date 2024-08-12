<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenExpiredException;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenInvalidException;
use PHPOpenSourceSaver\JWTAuth\Exceptions\JWTException;
use JWTAuth;

class UserController extends Controller
{
    public function user(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|unique:users,user_id',
            'firstName' => 'required',
            'lastName' => 'required',
            'gender' => 'required',
            'email' => 'required|email',
            'password' => 'required|string',
            'phoneNumber' => 'required',
            'profile_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('profile_path')) {
            $profilePath = $request->file('profile_path')->store('profiles', 'public');
            $validated['profile_path'] = $profilePath;
        }

        try {
            $user = User::create($validated);
            return response()->json(['success' => true, 'user' => $user]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'errors' => ['user_id' => 'User ID already exists']], 400);
        }
    }

    public function index()
    {
        $users = User::all();
        return response()->json(['users' => $users]);
    }

    public function show($id)
    {
        $user = User::find($id);
        if ($user) {
            return response()->json(['user' => $user]);
        } else {
            return response()->json(['message' => 'User not found.'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'firstName' => 'required|string|max:255',
                'lastName' => 'required|string|max:255',
                'gender' => 'required|string',
                'phoneNumber' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'password' => 'nullable|string|min:8',
                'profile_path' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
            ]);

            $user = User::findOrFail($id);
            $user->first_name = $validatedData['firstName'];
            $user->last_name = $validatedData['lastName'];
            $user->gender = $validatedData['gender'];
            $user->phone_number = $validatedData['phoneNumber'];
            $user->email = $validatedData['email'];
            if (!empty($validatedData['password'])) {
                $user->password = bcrypt($validatedData['password']);
            }
            if ($request->hasFile('profile_path')) {
                if ($user->profile_path) {
                    Storage::disk('public')->delete($user->profile_path);
                }
                $profilePath = $request->file('profile_path')->store('profiles', 'public');
                $user->profile_path = $profilePath;
            }
            $user->save();

            return response()->json(['success' => true, 'user' => $user]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['success' => false, 'message' => 'User not found'], 404);
        }
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();
            return response()->json(['success' => true]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['success' => false, 'message' => 'User not found'], 404);
        }
    }
    public function login(Request $request) {
        $user_login = [
            'user_id' => $request->login_user_id,
            'email' => $request->login_email,
            'password' => $request->login_password
        ];
        $token = JWTAuth::attempt($user_login);
        $user = Auth::user(); // Get current logged in user information

        if ($token) {
            return response()->json([
                'success' => true,
                'message' => 'Login successfully',
                'user' => $user,
                'token' => $token
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Invalid ID, email, or password',
            ]);
        }
    }

    public function logout()
    {
        try {
            $token = JWTAuth::getToken();
            JWTAuth::invalidate($token);
        } catch (TokenExpiredException $e) {
            // Handle token expiration
        } catch (TokenInvalidException $e) {
            // Handle invalid token
        } catch (JWTException $e) {
            // Handle JWT exception
        }

        return response()->json([
            'success' => true,
            'message' => 'Logout successfully',
        ]);
    }
}
