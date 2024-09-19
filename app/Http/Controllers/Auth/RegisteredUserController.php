<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): Response
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'photo' => ['sometimes', 'file', 'mimes:png,jpg'],
            'phone' => ['required', 'digits_between:10,15', 'unique:' . User::class],
            'address' => ['required', 'min:3']
        ]);

        if ($request->hasFile('photo')) {
            $fileName = Str::slug($request->name) . "-profile-image." . $request->photo->getClientOriginalExtension();
            $path = $request->file('photo')->storeAs('profile', $fileName);

            $validated['photo'] = $path;
        }

        User::create($validated);

        return Response::api('User registered!');
    }
}
