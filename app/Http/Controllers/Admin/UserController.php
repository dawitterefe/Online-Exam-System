<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::latest()->paginate(4);
        return view('admin.all-users', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.create-user', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'gender' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'roles' => ['required', 'integer'],
        ]);

        $user = User::create([
            'name' => $request->first_name,
            'avatar' => 'storage/avatar/avatar.png',
            'father_name' => $request->last_name,
            'gender' => $request->input('gender'),
            'email' => $request->email,
            'password' => bcrypt('password'),
            'role_id' => $request->roles,
        ]);

        return redirect()->route('users.index');
        // return $user->role->name;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);
        return view('admin.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $roles = Role::all();
        $user = User::findOrFail($id);
        return view('admin.edit-user', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $request->validate([

            'name' => ['string', 'max:255'],
            'fname' => ['string', 'max:255'],
            'email' => ['email', 'max:255'],
            'roles' => ['integer'],
        ]);

        if ($request->hasFile('avatar')) {

            $request->validate([

                'avatar' => ['max:2028', 'image']
            ]);

            $fileName = time() . '_' . $request->avatar->getClientOriginalName();
            $filePath = $request->avatar->storeAs('avatar', $fileName);

            if ($user->avatar != "storage/avatar/avatar.png") {

                unlink(public_path($user->avatar));
            }

            $user->avatar = 'storage/' . $filePath;
        }

        $user->name = $request->name;
        $user->father_name = $request->fname;
        $user->email = $request->email;
        $user->role_id = $request->roles;
        $user->gender = $request->input('gender');

        $user->save();

        return Redirect::route('users.edit',$user->id)->with('status', 'profile-updated');
        // return $user;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
