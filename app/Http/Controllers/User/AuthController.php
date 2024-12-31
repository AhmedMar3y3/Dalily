<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\user\forgot;
use App\Http\Requests\user\reset;
use App\Http\Requests\user\login;
use App\Http\Requests\user\store;
use App\Models\User;
use App\Notifications\resetPassword;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
class AuthController extends Controller
{
   public function register(store $request)
{
    try {
        $validatedData = $request->validated();
        $validatedData['password'] = Hash::make($request->password);
        $user = User::create($validatedData);
        $token = $user->createToken('api of token', [$user->name])->plainTextToken;

        return response()->json([
            'message' => 'تم التسجيل بنجاح', 
            'user'=>$user,
            'token'=>$token
            ],
            201);
    } catch (\Illuminate\Database\QueryException $e) {
        if ($e->getCode() == 23000) {
            return response()->json(['error' => 'رقم الهاتف أو البريد الإلكتروني مستخدم بالفعل'], 422);
        }
        throw $e;
    }
}

    public function login(login $request)
    {
        $user = User::where('email', $request->input('email'))->first();
        if (!$user || !Hash::check($request->input('password'), $user->password)) {
            return response()->json('بيانات غير صحيحة', 404);
        }
        $token = $user->createToken('api of token', [$user->name])->plainTextToken;
        return response()->json(
            [ 
               'message'=>'تم التسجيل بنجاح',
                'user' => $user->only(['id', 'name', 'email', 'phone','created_at','updated_at']),
                'token' => $token
            ]
        );
    
}

    
    public function logout()
    {

        $user = Auth::user();
        Auth::user()->tokens()->delete();
        return response()->json(['message'=>'تم تسجيل الخروج بنجاح'], 200);
    }



    public function forgotPassword(forgot $request)
    {

        $validatedData = $request->validated();
        $isEmail = filter_var($request->identifier, FILTER_VALIDATE_EMAIL);
        $user = $isEmail
            ? User::where('email', $request->identifier)->first()
            : User::where('phone', $request->identifier)->first();

        if (!$user) {
            return response()->json('المستخدم غير موجود', 404);
        }

        $code = mt_rand(1000, 9999);
        $code = str_pad($code, 4, '0', STR_PAD_LEFT);
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $isEmail ? $user->email : $user->phone],
            [
                'token' => $code,
                'created_at' => now()
            ]
        );

        if ($isEmail) {
            Mail::raw("رمز إعادة تعيين كلمة المرور الخاص بك هو: $code", function ($message) use ($user) {
                $message->to($user->email)
                    ->subject('رمز إعادة تعيين كلمة المرور');
            });
            return response()->json(['message' => 'تم إرسال رمز إعادة تعيين كلمة المرور إلى بريدك الإلكتروني']);
        } else {
            $user->notify(new resetPassword($code));
            return response()->json(['message' => 'تم إرسال رمز إعادة تعيين كلمة المرور إلى هاتفك']);
        }
    }


    public function resetPassword(reset $request)
    {

        $isEmail = filter_var($request->identifier, FILTER_VALIDATE_EMAIL);
        $resetEntry = DB::table('password_reset_tokens')
            ->where($isEmail ? 'email' : 'email', $request->identifier)
            ->where('token', $request->code)
            ->first();

        if (!$resetEntry) {
            return response()->json([
                'message' => 'رمز غير صالح',
            ], 404);
        }

        $user = $isEmail
            ? User::where('email', $request->identifier)->first()
            : User::where('phone', $request->identifier)->first();

        $user->password = Hash::make($request->password);
        $user->save();

        DB::table('password_reset_tokens')->where($isEmail ? 'email' : 'email', $request->identifier)->delete();
        return response()->json(['message' => 'تم إعادة تعيين كلمة المرور بنجاح']);
    }

}
