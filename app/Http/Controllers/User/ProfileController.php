<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\user\update;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ProfileController extends Controller
{

    public function getProfile()
    {
        $user = Auth::user();
        return response()->json($user, 200);
    }

    public function updateProfile(update $request)
    {
        $user = Auth::user();
        $validatedData = $request->validated();
    
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('users'), $imageName);
            $validatedData['image'] = env('APP_URL') . '/public/users/' . $imageName;
        }
        $user->update($validatedData);
        return response()->json(['message' => 'تم تعديل الصفحة الشخصية بنجاح'], 200);
    }
    
    public function changePassword(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();
        $validatedData = $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:6|confirmed',
        ]);
        if (!Hash::check($validatedData['current_password'], $user->password)) {
            return response()->json( 'كلمة المرور الحالية غير صحيحة.',400);
        }
        $user->password = Hash::make($validatedData['new_password']);
        $user->save();
        return response()->json( 'تم تغيير كلمة المرور بنجاح.', 200);
    }
    public function deleteAccount()
    {
        $user = Auth::user();
        $user->delete();
        return response()->json(['message' => 'تم حذف الحساب بنجاح'], 200);
    }
}
