<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Role;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;


class AdminController extends Controller
{
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        $notification = array(
            'message' => 'User log out successfuly',
            'alert-type' => 'success'
        );

        return redirect('/login')->with($notification);
    }

    public function profile()
    {
        $id = Auth::user()->id;
        $adminData = User::find($id);
        return view('admin.admin_profile_view', compact('adminData'));
    }

    public function EditProfile()
    {

        $id = Auth::user()->id;
        $editData = User::find($id);
        return view('admin.admin_profile_edit', compact('editData'));
    } // End Method 

    public function storeprofile(Request $request)
    {
        // dd($request);
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->username = $request->username;

        if ($request->file('profile_image')) {
            $file = $request->file('profile_image');

            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'), $filename);
            $data['profile_image'] = $filename;
        }
        $data->save();

        $notification = array(
            'message' => 'Admin profile updated successfuly',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.profile')->with($notification);
    } // End Method

    public function changepassword()
    {
        return view('admin.admin_change_password');
    } // End Method

    public function updatepassword(Request $request)
    {
        $validateData = $request->validate([
            'oldpassword' => 'required',
            'newpassword' => 'required',
            'confirmpassword' => 'required|same:newpassword',

        ]);

        $hashedPassword = Auth::user()->password;
        if (Hash::check($request->oldpassword, $hashedPassword)) {
            $users = User::find(Auth::id());
            $users->password = bcrypt($request->newpassword);
            $users->save();

            session()->flash('message', 'Password Updated Successfully');
            return redirect()->back();
        } else {
            session()->flash('message', 'Old password is not match');
            return redirect()->back();
        }
    } // End Method

    public function AllUser()
    {
        $user = User::all();
        return view('backend.user.allUser', compact('user'));
    }
    public function AllRole()
    {
        $role = Role::all();
        return view('backend.user.allRoles', compact('role'));
    }
    public function AddUser()
    {
        $roles = Role::all();

        return view('backend.user.addUser', compact('roles'));
    }
    public function AddRole()
    {

        return view('backend.user.addRole');
    }



    public function StoreUser(Request $request)
    {
        // dd($request);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'username' => ['required', 'string', 'max:255'],
            'role_id' => ['required', 'exists:roles,id'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'profile_image' => ['nullable', 'image', 'max:2048'], // Validate profile image
        ]);
        // dd($request);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'role_id' => $request->role_id,
            'password' => Hash::make($request->password),
        ]);

        if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'), $filename);
            $user->profile_image = $filename;
            $user->save();
        }

        $notification = array(
            'message' => 'User created successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.user')->with($notification);
    }

    public function StoreRole(Request $request)
    {

        Role::insert([
            'name' => $request->name,
        ]);

        $notification = array(
            'message' => 'Role is inserted successfuly',
            'alert-type' => 'success'
        );

        return redirect()->route('all.role')->with($notification);
    }
    public function UserEdit($id)
    {
        $roles = Role::all(); // Fetch all roles to populate the dropdown
        $user = User::findOrFail($id); // Fetch the user to be edited
        return view('backend.user.editUser', compact('user', 'roles'));
    }


    public function DeleteUser($id)
    {
        User::findOrFail($id)->delete();

        $notification = array(
            'message' => 'User is deleted successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function UpdateUser(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $id],
            'username' => ['required', 'string', 'max:255'],
            'role_id' => ['required', 'exists:roles,id'],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
            'profile_image' => ['nullable', 'image', 'max:2048'],
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->role_id = $request->role_id;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        if ($request->file('profile_image')) {
            $file = $request->file('profile_image');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'), $filename);
            $user->profile_image = $filename;
        }

        $user->save();

        $notification = array(
            'message' => 'User updated successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.user')->with($notification);
    }
}
