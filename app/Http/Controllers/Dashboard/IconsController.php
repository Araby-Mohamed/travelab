<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IconsController extends Controller
{
    /**
     * Get All Data Model
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        // Chunk Data To 4 Items
        $chunk = array_chunk(iconsList(), 4);
        return view('dashboard.icons.index', compact('chunk'));
    }
}
