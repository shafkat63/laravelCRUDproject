<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use PhpParser\Node\Expr\FuncCall;

class UserController extends Controller
{
    public function register(Request $request)
    {

        $incomingFields = $request->validate([
            'firstName' => ['required'],
            'lastName' => ['required'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min:8', 'max:200']
        ]);
        $incomingFields['password'] = bcrypt($incomingFields['password']);
        // dd($incomingFields);
        $user = User::create($incomingFields);
        auth()->login($user);
        return redirect('/');
    }
    public function logout()
    {
        auth()->logout();
        return redirect('/');
    }
    public function login(Request $request)
    {
        $incomingFields = $request->validate(
            [
                'loginEmail' => 'required',
                'loginPassword' => 'required'
            ]
        );
        // $incomingFields['password'] = bcrypt($incomingFields['password']);

        if (auth()->attempt(['email' => $incomingFields['loginEmail'], 'password' => $incomingFields['loginPassword']])) {
            $request->session()->regenerate();
        }
        return redirect('/');
    }
}
