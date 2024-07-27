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
        'user_id' => 'required|unique:users,user_id', // Ensure user_id is unique in the 'users' table
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
        $profilePath = $request->file('profile_path')->store('profiles', 'public');
        $validated['profile_path'] = $profilePath;
    }

    // Create user record
    try {
        $user = User::create($validated);
        return response()->json(['success' => true, 'user' => $user]);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'errors' => ['user_id' => 'User ID already exists']], 400);
    }
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
            $user = User::findOrFail($id,);
            return response()->json(['user' => $user]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'User not found'], 404);
        }
    }

    // Method to update a user
    // UserController.php

    // public function update(Request $request, $id)
    // {
    //     $user = User::findOrFail($id);
    
    //     // Validate the request
    //     $validatedData = $request->validate([
    //         'user_id' => 'required|string|max:255',
    //         'firstName' => 'required|string|max:255',
    //         'lastName' => 'required|string|max:255',
    //         'gender' => 'required|string|max:255',
    //         'phoneNumber' => 'required|string|max:15',
    //         'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
    //         'password' => 'nullable|string|min:8', // Password can be nullable for updates
    //         'profile_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    //     ]);
    
    //     // Handle the profile image upload
    //     if ($request->hasFile('profile_path')) {
    //         $imagePath = $request->file('profile_path')->store('profile_images', 'public');
    //         $validatedData['profile_path'] = $imagePath;
    //     }
    
    //     // Hash the password if provided
    //     if (!empty($validatedData['password'])) {
    //         $validatedData['password'] = bcrypt($validatedData['password']);
    //     } else {
    //         // Remove password from validated data if it's not being updated
    //         unset($validatedData['password']);
    //     }
    
    //     // Update the user
    //     $user->update($validatedData);
    
    //     return response()->json(['success' => true, 'user' => $user]);
    // }
    
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found.'], 404);
        }
    
        $validatedData = $request->validate([
            'user_id' => 'required|string|max:255',
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'gender' => 'required|string|max:255',
            'phoneNumber' => 'required|string|max:15',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8',
            'profile_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        if ($request->hasFile('profile_path')) {
            $imagePath = $request->file('profile_path')->store('profiles', 'public');
            $validatedData['profile_path'] = $imagePath;
        }
    
        if (!empty($validatedData['password'])) {
            $validatedData['password'] = bcrypt($validatedData['password']);
        } else {
            unset($validatedData['password']);
        }
    
        $user->update($validatedData);
        return response()->json(['success' => true, 'user' => $user]);
    }
    
    


public function delete($id) {
    $user = User::find($id);
    if ($user) {
        $user->delete();
        return response()->json(['message' => 'User deleted successfully']);
    }
    return response()->json(['message' => 'User not found']);
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
