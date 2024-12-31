<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Place;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function index()
    {
        $favorites = auth()->user()->favorites()->with('images')->withCount('reviews')->paginate(12);
        return response()->json($favorites, 200);
    }
    public function toggleFavorite(Request $request, $placeId)
    {
        $user = Auth::user();
        $place = Place::findOrFail($placeId);

        if ($user->favorites()->where('place_id', $placeId)->exists())
        {
            $user->favorites()->detach($placeId);
            return response()->json(['message'=>'تمت إزالة المكان من المفضلة'], 200);
        } else 
        {
            $user->favorites()->attach($placeId);
            return response()->json(['message'=>'تمت إضافة المكان إلى المفضلة'], 200);
        }
    }
}
