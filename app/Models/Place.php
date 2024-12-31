<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Place extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'map_disc',
        'longitude',
        'latitude',
        'rating',
        'status',
        'open_at',
        'close_at',
        'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(PlaceImage::class);
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function favoritedBy()
{
    return $this->belongsToMany(User::class, 'favorites', 'place_id', 'user_id');
}
public function updateStatus()
{
    $currentTime = Carbon::now('Africa/Cairo')->format('H:i:s');
    $isOpen = false;

    if ($this->open_at < $this->close_at) {
        $isOpen = $currentTime >= $this->open_at && $currentTime <= $this->close_at;
    } else {
        $isOpen = $currentTime >= $this->open_at || $currentTime <= $this->close_at;
    }

    $this->update(['status' => $isOpen ? 'مفتوح' : 'مغلق']);
}

}
