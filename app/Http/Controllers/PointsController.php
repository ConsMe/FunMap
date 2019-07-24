<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Point;
use App\Category;
use App\Http\Requests\NewPoint;

class PointsController extends Controller
{
    public function initData()
    {
        $points = Point::with('category:id,name')->get();
        $categories = Category::get(['id', 'name']);
        return response()->json(compact(['points', 'categories']));
    }

    public function addPoint(NewPoint $request)
    {
        $point = Point::create([
            'lat_lng' => json_encode([$request->lat, $request->lng]),
            'category_id' => $request->category_id,
            'comment' => $request->comment ?: NULL
        ]);

        return $point->load('category:id,name');
    }
}
