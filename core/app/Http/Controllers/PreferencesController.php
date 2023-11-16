<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class PreferencesController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validPreferences = [
            'Hot Spring',
            'Fish Feeding',
            'Beach',
            'Parking',
            'Island Hopping',
            'Forest',
            'Boat'
        ];

        $validatedData = $request->validate([
            'preferences' => 'required|array|min:3|max:3', // Ensure 'preferences' is an array with 1 to 3 elements
            'preferences.*' => 'in:' . implode(',', $validPreferences), // Validate each element of 'preferences'
        ]);

        $user = User::find(auth()->user()->id);

        $preferencesData = ['values' => json_encode($validatedData['preferences'])];

        $user->preferences()->create($preferencesData);

        return redirect()->route('home')->with('preferences-success', 'Preferences saved successfully!');
    }
}
