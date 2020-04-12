<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(function($request, $next) {
            if (Gate::allows('manage-users')) return $next($request);
            abort(403);
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users          = User::paginate(10);
        $filterKeyword  = $request->get('keyword');
        $status         = $request->get('status');
        if ($filterKeyword) {
            if ($status) {
                $users = User::where('email', 'LIKE', "%$filterKeyword%")
                    ->where('status', $status)
                    ->paginate(10);
            } else {
                $users = User::where('email', 'LIKE', "%$filterKeyword%")
                    ->paginate(10);
            }
        }

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("users.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            "name"      => "required|min:5|max:100",
            "username"  => "required|min:5|max:20",
            "roles"     => "required",
            "phone"     => "required|digits_between:10,12",
            "address"   => "required|min:20|max:200",
            "avatar"    => "required",
            "email"     => "required|email",
            "password"  => "required",
            "password_confirmation"  => "required|same:password",
        ])->validate();

        $user           = new User();
        $user->name     = $request->get('name');
        $user->username = $request->get('username');
        $user->roles    = json_encode($request->get('roles'));
        $user->address  = $request->get('address');
        $user->phone    = $request->get('phone');
        $user->email    = $request->get('email');
        $user->password = Hash::make($request->get('password'));
        $user->status   = $request->get('status');
        if ($request->file('avatar')) {
            $file = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $file;
        }

        $user->save();
        return redirect()->route('users.create')->with('status', 'User Successfully Created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Validator::make($request->all(), [
            "name"      => "required|min:5|max:100",
            "roles"     => "required",
            "phone"     => "required|digits_between:10,12",
            "address"   => "required|min:20|max:200",
            "avatar"    => "required",
        ])->validate();

        $user = User::findOrFail($id);
        $user->name     = $request->get('name');
        $user->roles    = json_encode($request->get('roles'));
        $user->address  = $request->get('address');
        $user->phone    = $request->get('phone');
        $user->status   = $request->get('status');
        if ($request->file('avatar')) {
            if ($user->avatar && file_exists(storage_path('app/public/' . $user->avatar))) {
                Storage::delete('public/' . $user->avatar);
            }
            $file = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $file;
        }
        $user->save();
        return redirect()->route('users.edit', [$id])->with('status', 'User Successfully Updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('status', 'User Successfully Deleted.');
    }
}
