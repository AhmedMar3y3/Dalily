<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\place\store;
use App\Http\Requests\place\update;
use App\Models\Category;
use App\Models\Place;

class PlaceController extends Controller
{

    public function index()
    {
        $query = Place::with('category');

        if (request()->has('search')) {
            $search = request()->input('search');
            $query->where('name', 'like', "%{$search}%")
                  ->orWhereHas('category', function($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%");
                  });
        }

        $places = $query->paginate(15);
        return view('place.index', compact('places'));
    }

public function show($id)
{
    $place = Place::with('category','images')->find($id);
    $place->updateStatus();
    return view('place.show', compact('place'));
}

public function create()
{
    $categories = Category::all();
    return view('place.create', compact('categories'));
}

public function store(store $request)
{
    $validatedData = $request->validated();
    $place = Place::create($request->except('images'));

    if ($request->has('images')) {
        foreach ($request->file('images') as $image) {
            try {
                $destinationPath = public_path('places');
                $fileName = uniqid() . '_' . $image->getClientOriginalName();
                $image->move($destinationPath, $fileName);
                $imageFullUrl = url('places/' . $fileName);

                $place->images()->create([
                    'image' => $imageFullUrl,
                ]);
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            }
        }
    }
    return redirect()->route('admin.places.index')->with('success', 'Place created successfully');
}


public function edit(Place $place, $id)
{
    $place = Place::with('images','category')->find($id);
    $categories = Category::all();
    return view('place.edit', compact('place', 'categories'));
}

public function update(update $request, $id)
{
    $place = Place::find($id);

    if (!$place) {
        return redirect()->back()->withErrors(['error' => 'Place not found']);
    }

    $validatedData = $request->validated();

    $place->update($request->except('images'));

    if ($request->has('images')) {
        $place->images()->delete();

        foreach ($request->file('images') as $image) {
            try {
                $destinationPath = public_path('places');
                $fileName = uniqid() . '_' . $image->getClientOriginalName();
                $image->move($destinationPath, $fileName);
                $imageFullUrl = url('places/' . $fileName);

                $place->images()->create([
                    'image' => $imageFullUrl,
                ]);
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            }
        }
    }

    return redirect()->route('admin.places.index')->with('success', 'Place updated successfully');
}


public function destroy($id)
{
    $place = Place::find($id);
    $place->delete();
    return redirect()->route('admin.places.index')->with('success', 'Place deleted successfully');
}
}
