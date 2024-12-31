<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\login;
use App\Http\Requests\admin\store;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //API
    public function register(store $request)
    {

        $validatedData = $request->validated();
        $validatedData['password'] = Hash::make($validatedData['password']);
        $admin = Admin::create($validatedData);
        return response()->json($admin, 201);
    }

    //WEB
    public function loadLoginPage()
    {
        return view('login');
    }

    public function loginUser(login $request)
    {
        $credentials = $request->validated();
        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('admin.dashboard')->with('success', 'Successfully logged in');
        }

        return back()->withErrors(['error' => 'Invalid Credentials'])->withInput();
    }


    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('loginPage')->with('success', 'Logged out successfully');
    }

}
