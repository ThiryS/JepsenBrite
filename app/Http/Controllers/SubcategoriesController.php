<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subcategory;

class SubcategoriesController extends Controller
{
    public function index()
    {
        // Retrieve events from db using eloquent
        $subcategories = Subcategory::all();
        // render the view with the events
        return view('events/create', ['subcategories' => $subcategories]);
    }
}
