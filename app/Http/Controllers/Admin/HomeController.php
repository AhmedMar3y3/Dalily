<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Place;
use App\Models\User;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function stats(){

        $places = Place::count();
        $users = User::count();
        $reviews = Review::count();
        $last7DaysUsers = collect();
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->toDateString();
            $userCount = User::whereDate('created_at', $date)->count();
            $last7DaysUsers->put($date, $userCount);
        }

        return view('dashboard', compact( 'places', 'users', 'reviews', 'last7DaysUsers'));
    }
}
