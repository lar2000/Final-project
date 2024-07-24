<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function user(Request $request)
    {
        // Validate incoming request
        $validated = $request->validate([
            'user_id' => 'required',
            'firstName' => 'required',
            'lastName' => 'required',
            'gender' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'phoneNumber' => 'required',
            'profile_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Handle profile image upload if present
        if ($request->hasFile('profile_path')) {
            $profilePath = $request->file('profile_path')->store('profiles');
            $validated['profile_path'] = $profilePath;
        }

        // Create user record
        $user = User::create($validated);

        return response()->json(['success' => true, 'user' => $user]);
    }
    // Method to fetch all users
    public function index()
    {
        $users = User::all();
        return response()->json(['users' => $users]);
    }

    // Method to fetch a single user
    public function show($id)
    {
        try {
            $user = User::findOrFail($id);
            return response()->json(['user' => $user]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'User not found'], 404);
        }
    }

    // Method to update a user
    public function update(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);

            // Validate incoming request
            $validator = Validator::make($request->all(), [
                'firstName' => 'required',
                'lastName' => 'required',
                'gender' => 'required',
                'email' => 'required|email',
                'password' => 'required',
                'phoneNumber' => 'required',
                'profile_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 400);
            }

            // Update user record
            $user->update($request->all());

            return response()->json(['message' => 'User updated successfully', 'user' => $user]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'User not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to update user', 'error' => $e->getMessage()], 500);
        }
    }

    // Method to delete a user
    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();
            return response()->json(['message' => 'User deleted successfully']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'User not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to delete user', 'error' => $e->getMessage()], 500);
        }
    }
}
