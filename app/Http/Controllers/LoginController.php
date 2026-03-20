<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class LoginController extends Controller
{
    public function login()
    {   
        return view('auth.login');
    }
    public function postLogin(Request $request)
    {
      
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        \Log::info('postLogin', $request->all());
        $remember = $request->boolean('remember');
        
        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password], $remember)){
            // Regenerate session to prevent session fixation
            $request->session()->regenerate();
            
            return response()->json([
                'status'=>true,
                'message'=>'Login successful1',
                'remember_set' => $remember
            ]);
        }
        return response()->json(['status'=>false,'message'=>'Invalid credentials1']);
    }
    public function logout(Request $request)
    {
        // Get the user before logout (if authenticated)
        $user = Auth::user();
        
        // Logout - this automatically clears the remember token cookie
        Auth::logout();
        
        // Invalidate the session
        $request->session()->invalidate();
        
        // Regenerate CSRF token for security
        $request->session()->regenerateToken();
        
        // Clear remember token from database to prevent reuse
        if ($user) {
            $user->setRememberToken(null);
            $user->save();
        }
        
        return redirect()->route('login');
    }
}
