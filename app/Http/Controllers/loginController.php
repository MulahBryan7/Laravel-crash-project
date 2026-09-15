<?php
/*Controller (app/Http/Controllers/): Your userController receives the user request, 
executes the logic, and returns a response/redirect. */

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class loginController extends Controller
{
    public function login(Request $request)
    {
        $incomingFields = $request->validate([
            'name' => ['required', 'min:2', 'max:130'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min:4', 'max:100']
        ]);
        $incomingFields['password'] = bcrypt($incomingFields['password']);
        $user = User::create($incomingFields);       //executes INSERT INTO users ...
        auth()->login($user);                    // sets session cookie
        return redirect('/');
    }

    public function logout(Request $request)
    {

        Auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function connection(Request $request)
    {
        $incomingFields = $request->validate([
            'connect_name' => 'required',
            'connect_password' => 'required'
        ]);
        if (auth()->attempt(['name' => $incomingFields['connect_name'], 'password' => $incomingFields['connect_password']])) {
            $request->session()->regenerate();
        }
        return redirect('/');
    }
}
