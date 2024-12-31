<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rating;
use App\Models\Place;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function rate(Request $request, $placeId)
    {
        $validatedData = $request->validate([
            'rating' => 'required|numeric|in:1,1.5,2,2.5,3,3.5,4,4.5,5',
        ]);

        $userId = Auth::id();

        $existingRating = Rating::where('user_id', $userId)
            ->where('place_id', $placeId)
            ->first();

        if ($existingRating) {
            $existingRating->update(['rating' => $validatedData['rating']]);
        } else {
            Rating::create([
                'user_id' => $userId,
                'place_id' => $placeId,
                'rating' => $validatedData['rating'],
            ]);
        }

        $this->updatePlaceRating($placeId);

        return response()->json(['message'=>'تم إضافة التقييم بنجاح'], 200);
    }

    private function updatePlaceRating($placeId)
    {
        $averageRating = Rating::where('place_id', $placeId)->avg('rating');

        $place = Place::findOrFail($placeId);
        $place->update(['rating' => $averageRating]);
    }
}
