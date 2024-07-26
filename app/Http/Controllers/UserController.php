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
        $profilePath = $request->file('profile_path')->store('profiles');
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

    public function update(Request $request, $id) {
        $validatedData = $request->validate([
            'user_id' => 'required',
            'firstName' => 'required|string',
            'lastName' => 'required|string',
            'gender' => 'required|in:ຊາຍ,ຍິງ,ອື່ນໆ', // Make sure the validation matches your options
            'phoneNumber' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string',
            'profile_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048' // Ensure these match your allowed formats
        ]);
    
        $user = User::find($id);
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'User not found.']);
        }
    
        $user->firstName = $validatedData['firstName'];
        $user->lastName = $validatedData['lastName'];
        $user->gender = $validatedData['gender'];
        $user->phoneNumber = $validatedData['phoneNumber'];
        $user->email = $validatedData['email'];
        $user->password = bcrypt($validatedData['password']);
        
        if ($request->hasFile('profile_path')) {
            $path = $request->file('profile_path')->store('public/images');
            $user->profile_path = basename($path);
        }
    
        $user->save();
        return response()->json(['success' => true]);
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
