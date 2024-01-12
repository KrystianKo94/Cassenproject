<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class ChangePasswordController extends Controller
{
    public function index()
    {
        return view('change-password');
    }

    public function update(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => [
                'required',
                'min:5',
                'confirmed',
                'regex:/^(?=.*[A-Z])(?=.*\d)/',
            ],
        ]);

        $user = $request->user();

        if (!$user || !Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }

        $user->update(['password' => bcrypt($request->new_password)]);

        $request->session()->flash('success', 'Password changed successfully.');

        return redirect()->route('home');
    }

}
