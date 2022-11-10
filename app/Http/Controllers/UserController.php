<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.master_data.users.index', [
            'users' => User::where('role', 2)->orderByDesc('created_at')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.master_data.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|min:3|max:100',
            'email' => 'required|min:10|max:100|unique:users|email:dns',
            'username' => 'required|min:3|max:100|unique:users',
            'password' => 'required|min:6|max:100|'
        ]);

        // encrypt password to hash
        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);
        return redirect('/admin/users')->with('success', 'User created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('backend.master_data.users.edit', [
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $rules = [
            'name' => 'required|min:3|max:100',
        ];

        if ($request->email != $user->email) {
            $rules['email'] = 'required|min:10|max:100|unique:users|email:dns';
        }

        if ($request->username != $user->username) {
            $rules['username'] = 'required|min:3|max:100|unique:users';
        }

        if ($request->has('password')) {
            $rules['password'] = 'nullable|min:6|max:100';
        }

        $validatedData = $request->validate($rules);

        if ($validatedData['password'] != '') {
            // encrypt password to hash
            $validatedData['password'] = Hash::make($validatedData['password']);
        } else {
            $validatedData['password'] = $user->password;
        }

        User::where('id', $user->id)
            ->update($validatedData);

        return redirect('/admin/users')->with('success', 'User updated succesfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        User::destroy($user->id);
        return redirect('/admin/users')->with('success', 'User deleted succesfully');
    }
}
