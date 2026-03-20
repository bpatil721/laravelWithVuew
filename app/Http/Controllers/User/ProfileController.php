<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Return JSON if it's an AJAX request
        if (request()->expectsJson() || request()->ajax()) {
            return response()->json([
                'user' => $user
            ]);
        }
        
        return view('user.profile', compact('user'));
    }
    
    public function update(Request $request)
    {
        $user = Auth::user();
        \Log::info('update', $request->all());
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'profile_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);
        
        $user->name = $request->name;
        $user->email = $request->email;
        
        // Handle profile image upload
        if ($request->hasFile('profile_image')) {
            // Delete old image if exists
            if ($user->getOriginal('profile_image') && !str_starts_with($user->getOriginal('profile_image'), 'data:')) {
                Storage::disk('public')->delete($user->getOriginal('profile_image'));
            }
            
            // Store new image
            $path = $request->file('profile_image')->store('profile-images', 'public');
            $user->profile_image = $path;
        }
        
        $user->save();
        
        // Return JSON if it's an AJAX request
        if (request()->expectsJson() || request()->ajax()) {
            return response()->json([
                'message' => 'Profile updated successfully!',
                'user' => $user->fresh()
            ]);
        }
        
        return redirect()->route('user.profile')->with('success', 'Profile updated successfully!');
    }
    
    public function changePassword(Request $request)
    {
       
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'new_password' => ['required', 'confirmed'],
        ], [
            'current_password.current_password' => 'The current password is incorrect.',
        ]);
        
        $user = Auth::user();
        $user->password = Hash::make($request->new_password);
        $user->save();
        
        // Return JSON if it's an AJAX request
        if (request()->expectsJson() || request()->ajax()) {
            return response()->json([
                'message' => 'Password updated successfully!'
            ]);
        }
        
        return redirect()->route('user.profile')->with('password_success', 'Password updated successfully!');
    }
}
