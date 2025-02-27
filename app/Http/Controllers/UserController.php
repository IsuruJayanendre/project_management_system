<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    //view users
    public function index()
    {
        $users=User::all();
        return view('users.index', compact('users'));
    }

    //create users form
    public function create()
    {
        return view('users.create');
    }

    //create user
    public function store(Request $request)
    {
        try{

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15|unique:users,phone',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string|in:marketing,user',
        ]);

        // Create user
        $user = User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'usertype' => $request->role,
        ]);
        Alert::success('Success', 'User added successfully!');
    }catch (\Exception $e) {
            Alert::error('Error', 'Something went wrong!');
        }
        return redirect()->route('users.index');
    }

    //edit user form
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    //seve edited data
    public function update(Request $request, User $user)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
                'role' => 'required',

                // Password validation (if user wants to update)
                'old_password' => 'nullable|string|min:6',
                'new_password' => 'nullable|string|min:6|confirmed',
            ]);

            if ($request->filled('old_password') && $request->filled('new_password')) {
                if (!Hash::check($request->old_password, $user->password)) {
                    return redirect()->back()->with('error', 'Old password is incorrect!');
                }
    
                $user->password = Hash::make($request->new_password);
            }

            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'userType' => $request->role,
            ]);

            Alert::success('Success', 'User updated successfully!');
        } catch (\Exception $e) {
            Alert::error('Error', 'Something went wrong!');
        }
        return redirect()->route('users.index');
    }

    //delete users
    public function destroy(User $user)
    {
        try {
            // Prevent SuperAdmin from deleting themselves
            if (auth()->user()->id === $user->id) {
                return redirect()->back()->with('error', 'You cannot delete yourself!');
            }

            $user->delete();

            Alert::success('Success', 'User deleted successfully!');
        } catch (\Exception $e) {
            Alert::error('Error', 'Something went wrong!');
        }
        return redirect()->back();
    }

}
