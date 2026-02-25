<?php

namespace App\Http\Controllers;

class GreetingController extends Controller
{
    public function index()
    {
        $hour = Carbon::now()->format('G'); // Get 24-hour format

        // Define the logic
        if ($hour < 12) {
            $greeting = 'Good Morning, Gorgeous!';
            $mood = 'text-yellow-600'; // Sunny vibe
        } elseif ($hour < 17) {
            $greeting = 'Good Afternoon, Sunshine!';
            $mood = 'text-orange-500'; // Bright vibe
        } else {
            $greeting = 'Good Evening, Stunning!';
            $mood = 'text-indigo-800'; // Relaxing vibe
        }

        return view('greeting', compact('greeting', 'mood'));
    }
}
