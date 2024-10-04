<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserSavedTweetsController extends Controller
{
    //
     public function index()
    {
        $savedTweets = auth()->user()->savedTweets()->get();

        return view('savedTweets.index', compact('savedTweets'));
    }
}
