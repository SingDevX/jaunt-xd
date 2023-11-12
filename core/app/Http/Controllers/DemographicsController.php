<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class DemographicsController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'income' => 'required|numeric',
            'family_size' => 'required|integer',
            'gender' => 'required|in:Male,Female,Other',
        ]);
    
        $user = User::find(auth()->user()->id);
    
        // Create a new Demographics record for the current user
        $user->demographics()->create($validatedData);

        return redirect('/user/dashboard');
    }
}
