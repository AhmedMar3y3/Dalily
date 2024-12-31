<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\location\store;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function storeLocation(store $request)
    {
        $user = auth()->user();
        $location = $user->location()->first();

        if ($location) {
            $location->update($request->validated());
            return response()->json(['message' => 'تم تحديث الموقع بنجاح'], 200);
        } else {
            $user->location()->create($request->validated());
            return response()->json(['message' => 'تم حفظ الموقع بنجاح'], 201);
        }
    }
    

}
