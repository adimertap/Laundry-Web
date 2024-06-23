<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionTestController extends Controller
{
    public function storeSession(Request $request)
    {
        // Store a value in the session
        $request->session()->put('key', 'value');
        return "Session value has been stored.";
    }

    public function showSession(Request $request)
    {
        // Retrieve the value from the session
        $value = $request->session()->get('key', 'No session value found.');
        return "Session Value: " . $value;
    }
}
