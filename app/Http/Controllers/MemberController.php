<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;

class MemberController extends Controller
{
    public function create()
    {
        return view('register'); // shows the form
    }

    public function store(Request $request)
    {
        // Validate data
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:members',
            'phone' => 'nullable|string',
        ]);

        // Save data to members table
        Member::create($request->all());

        return redirect('/members')->with('success', 'Member registered successfully!');
    }
}
