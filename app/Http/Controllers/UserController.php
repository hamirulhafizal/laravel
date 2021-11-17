<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function __construct() {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(20);

        return view('admin.user.index', [ 'users' => $users ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // echo  'Simpan pengguna baru';

        $form_data = $request->validate([
            'name' => 'required|min:5|max:255',
            'email' => 'required|email',
            'password' => 'required|confirmed'
        ]);

        $form_data['password'] = Hash::make( $form_data['password'] );

        $user = User::create($form_data);

        return redirect('admin/user')->with('success', "Pengguna {$user->name} ($user->id) telah ditambah");

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $user = User::find($id);
        $roles = Role::all();
        // dd($user);

        return view('admin.user.edit', [ 'user' => $user, 'roles' => $roles ]);
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
        $user = User::findOrFail($id);

        $form_data = $request->validate([
            'name' => 'required|min:5|max:255',
            'email' => 'required|email'
        ]);

        $user->name = $form_data['name'];
        $user->email = $form_data['email'];

        $user->save();

        $user->roles()->sync( $request->roles );

        return redirect('admin/user')->with('success', "Pengguna {$user->name} ($id) telah dikemaskini");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
