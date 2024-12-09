<?php

namespace App\Services;

use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Speciality;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class UserServices
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function index()
{    
    $auth = Auth::user();
    $userList = User::with('roles', 'speciality');
    
    if ($auth->hasRole('doctor') || $auth->hasRole('secretary')) {
        $userList->whereHas('roles', function ($query) {
            $query->where('name', 'patient');
        })->where('status', true);
    }
    
    if ($auth->hasRole('patient')) {
        $userList->whereHas('roles', function ($query) {
            $query->where('name', 'doctor');
        })->where('status', true);
    }

    $users = $userList->paginate(10);

    return view('templatesApp.user', compact('users'));
}


    public function create()
    {
        $specialities = Speciality::all();
        return view('templatesApp.userCreate', compact('specialities'));
    }

    public function store(UserRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'identity_card' => $request->identity_card,
            'birthday' => $request->birthday,
        ]);
    
        $user->speciality_id = $request->speciality_id;
        $user->save();
        
        return redirect()->route('users.index')->with('success', 'Usuario creado exitosamente.');
    }

    public function show(string $id)
    {
        $user = User::with('roles', 'speciality')->find($id);
        if(!$user)
        {
            return back()->with('error', 'El usuario no fue encontrado.');
        }
        return view('templatesApp.userShow', compact('user'));
    }

    public function edit(string $id)
    {
        $user = User::find($id);
        $specialities = Speciality::all();
        return view('templatesApp.userCreate', compact('user','specialities'));
    }

    public function update(UserRequest $request, string $id)
    {
        $user = User::find($id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'identity_card' => $request->identity_card,
            'birthday' => $request->birthday,
        ]);

        if ($request->filled('speciality_id')) {
            $user->speciality_id = $request->speciality_id;
            $user->save();
        }

        return redirect()->route('user.index')->with('success', 'Usuario actualizado exitosamente.');
    }

    public function destroy(string $id)
    {
        $user = User::find($id);
        if(!$user)
        {
            return back()->with('error', 'El usuario no fue encontrado.');
        }
        $user->update([
            'status' => false,
        ]);

        return redirect()->route('user.index')->with('success', 'Usuario eliminado exitosamente.');
    }
}
