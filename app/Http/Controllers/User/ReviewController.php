<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Http\Requests\Review\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{

    public function store(Store $request, $placeId)
    {
        $validatedData = $request->validated();
        $validatedData['place_id'] = $placeId;
        $validatedData['user_id'] = Auth::id();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('reviews'), $imageName);
            $validatedData['image'] = env('APP_URL') . '/public/reviews/' . $imageName;
        }
        $review = Review::create($validatedData);
        return response()->json(['message'=>'تم حفظ التقييم بنجاح'], 201);
    }

    public function destroy($id)
    {
        $review = Review::find($id);
        if (!$review) {
            return response()->json(['message'=>'التقييم غير موجود'], 404);
        }
        $review->delete();
        return response()->json(['message'=>'تم مسح التقييم بنجاح'], 200);
    }
}


