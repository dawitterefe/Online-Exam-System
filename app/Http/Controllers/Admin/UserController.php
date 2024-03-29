<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Evaluator;
use App\Models\Role;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use sirajcse\UniqueIdGenerator\UniqueIdGenerator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::latest()->paginate(4);
        return view('admin.users', compact('users'));
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
            // 'password' => bcrypt($request->email . '#' . $request->last_name),
            'role_id' => $request->roles,
        ]);


        if ($user->role->name == 'Student') {

            $id = UniqueIdGenerator::generate([
                'table' => 'students', 'length' => 14, 'prefix' => 'dbus-', 'suffix' => date('-Y')
            ]);

            $student = Student::create([
                'id' => $id,
                'user_id' => $user->id,
            ]);
        }

        if ($user->role->name == 'Teacher') {

            $id = UniqueIdGenerator::generate([
                'table' => 'teachers', 'length' => 14, 'prefix' => 'dbut-', 'suffix' => date('-Y')
            ]);

            $teacher = Teacher::create([
                'id' => $id,
                'user_id' => $user->id,
            ]);
        }

        if ($user->role->name == 'Evaluator') {

            $id = UniqueIdGenerator::generate([
                'table' => 'evaluators', 'length' => 14, 'prefix' => 'dbue-', 'suffix' => date('-Y')
            ]);

            $evaluator = Evaluator::create([
                'id' => $id,
                'user_id' => $user->id,
            ]);
        }

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
        $roles = Role::whereNotIn('name', ['Student'])->get();
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
        $user->gender = $request->input('gender');

        if ($user->role->id != 3) {

            $oldRole = $user->role;
            $newRole = Role::find($request->input('role'));

            // This happen if the role is changed in the form
            if ($oldRole->id != $newRole->id) {

                $user->role_id = $newRole->id;
                $user->save();

                if ($oldRole->id == 4) {
                    $teacher = Teacher::where('user_id', $user->id)->first();
                    $teacher->delete();
                }

                if ($oldRole->id == 2) {
                    $evaluator = Evaluator::where('user_id', $user->id)->first();
                    $evaluator->delete();
                }

                if ($newRole->id == 2) {

                    $id = UniqueIdGenerator::generate([
                        'table' => 'evaluators', 'length' => 14, 'prefix' => 'dbue-', 'suffix' => date('-Y')
                    ]);

                    $evaluator = Evaluator::create([
                        'id' => $id,
                        'user_id' => $user->id,
                    ]);
                }

                if ($newRole->id == 4) {

                    $id = UniqueIdGenerator::generate([
                        'table' => 'teachers', 'length' => 14, 'prefix' => 'dbut-', 'suffix' => date('-Y')
                    ]);

                    $evaluator = Teacher::create([
                        'id' => $id,
                        'user_id' => $user->id,
                    ]);
                }
            }
        }

        $user->save();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('users.index');
    }

    public function Trashed()
    {
        $users = User::onlyTrashed()->paginate(4);

        return view('admin.trashed-user', compact('users'));
    }

    public function restore($id)
    {

        $user = User::onlyTrashed()->findOrFail($id);
        $user->restore();

        return redirect()->route('users.index');
    }
    public function forceDelete($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);

        if ($user->avatar != "storage/avatar/avatar.png") {

            unlink(public_path($user->avatar));
        }

        $user->forceDelete();

        return redirect()->route('users.index');
    }
}
